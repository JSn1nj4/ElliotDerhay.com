<?php

use App\DataTransferObjects\GithubUserDTO;
use App\Events\NewGithubEventTypesEvent;
use App\Models\GithubUser;
use App\Services\Github\Endpoints\GetUserEndpoint;
use App\Services\Github\GithubService;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Tests\Support\GithubEventDataFactory;
use Tests\Support\GithubUserDataFactory;
use Tests\Support\PrivateMemberAccessor;

use function Pest\Faker\fake;
use function Pest\Laravel\mock;

it('creates an instance of App\Services\GithubService', function (): void {
	$githubService = resolve(GithubService::class);

	expect($githubService)->toBeInstanceOf(GithubService::class);
});

it('throws an exception if no token is found', function (): void {
	Config::offsetUnset('services.github.token');

	resolve(GithubService::class);
})->throws(Exception::class, "Config option 'services.github.token' not set.");

it('throws an exception if email recipient name is not set', function (): void {
	Config::offsetUnset('mail.to.name');

	resolve(GithubService::class);
})->throws(Exception::class, "Config option 'mail.to.name' not set.");

it('throws an exception if email recipient address is not set', function (): void {
	Config::offsetUnset('mail.to.address');

	resolve(GithubService::class);
})->throws(Exception::class, "Config option 'mail.to.address' not set.");

it('throws an exception if requested event count is < 1', function (): void {
	resolve(GithubService::class)->getEvents(
		fake()->userName(),
		0 - fake()->numberBetween()
	);
})->throws(Exception::class, "'\$count' value must be 1 or higher.");

it('throws an exception if requested event count is > 100', function (): void {
	resolve(GithubService::class)->getEvents(
		fake()->userName(),
		fake()->numberBetween(101)
	);
})->throws(Exception::class, "'\$count' value must be 100 or less.");

it('processes response data received from the github events api', function (): void {
	$user = fake()->userName();
	$eventCount = fake()->numberBetween(1, 100);

	Http::fake([
		"api.github.com/users/{$user}/events/public*" =>
		Http::response(json_encode(GithubEventDataFactory::init()
			->count($eventCount)
			->make())),
	]);

	Mail::fake();

	$events = resolve(GithubService::class)->getEvents($user, $eventCount);

	expect($events)
		->toBeInstanceOf(Collection::class)
		->and(count($events))
		->toBeLessThanOrEqual($eventCount);
});

it('filters out unsupported types of github events', function (): void {
	$user = fake()->userName();
	$eventCount = fake()->numberBetween(1, 100);

	$responseData = GithubEventDataFactory::init()
			->count($eventCount)
			->make();

	Http::fake([
		"api.github.com/users/{$user}/events/public*" =>
		Http::response(json_encode($responseData)),
	]);

	Mail::fake();

	$githubService = resolve(GithubService::class);

	// Make supportedEventTypes list accessible
	$supportedEventTypes = PrivateMemberAccessor::make()
		->from($githubService)
		->getProperty('supportedEventTypes');

	// Build and sum lists of supported and unsupported events
	[$supportedEvents, $unsupportedEvents] = collect($responseData)
		->partition(function ($event) use ($supportedEventTypes) {
			return in_array($event['type'], $supportedEventTypes);
		});

	// "fetch" events
	$events = $githubService->getEvents($user, $eventCount);

	// List unsupported event types that were missed in filtering
	$eventTypesMissed = $events->whereNotInStrict('type', $supportedEventTypes)
		->unique()
		->values();

	// Confirm expectations
	expect($events->toArray())
		->toHaveCount($supportedEvents->count())
		->and($events->count())
		->toBeLessThanOrEqual($eventCount)
		->and($eventTypesMissed)
		->toHaveCount(0);
});

it('does not dispatch notification if no unsupported event types are found', function(): void {
	$user = fake()->userName();
	$eventCount = fake()->numberBetween(1, 100);

	$githubService = resolve(GithubService::class);

	// Make supportedEventTypes list accessible
	$supportedEventTypes = PrivateMemberAccessor::make()
		->from($githubService)
		->getProperty('supportedEventTypes');

	Http::fake([
		"api.github.com/users/{$user}/events/public*" =>
		Http::response(json_encode(GithubEventDataFactory::init()
			->count($eventCount)
			->withTypes($supportedEventTypes)
			->make())),
	]);

	Mail::fake();

	Event::fake();

	// "fetch" events
	$githubService->getEvents($user, $eventCount);

	Event::assertNotDispatched(NewGithubEventTypesEvent::class);
});

it('dispatches notification if unsupported event types are filtered out', function (): void {
	$user = fake()->userName();
	$eventCount = fake()->numberBetween(1, 100);

	$githubService = resolve(GithubService::class);

	// Force generate only unsupported event types
	$unsupportedEventTypes = array_diff(
		PrivateMemberAccessor::make()
			->from(GithubEventDataFactory::init())
			->getProperty('eventTypes'),
		PrivateMemberAccessor::make()
		->from($githubService)
		->getProperty('supportedEventTypes')
	);

	Http::fake([
		"api.github.com/users/{$user}/events/public*" =>
		Http::response(json_encode(GithubEventDataFactory::init()
			->withTypes($unsupportedEventTypes)
			->count(100)
			->make())),
	]);

	Mail::fake();

	Event::fake();

	// "fetch" events
	$githubService->getEvents($user, $eventCount);

	Event::assertDispatched(NewGithubEventTypesEvent::class);
});

it('returns a `Illuminate\Http\Client\Response` instance from the `call()` method', function (): void {
	Http::fake();

	$endpoint = GetUserEndpoint::make()
		->withUser(fake()->userName())
		->with([
			"Authorization" => "Bearer " . config('services.github.token'),
		]);

	expect(resolve(GithubService::class)->call($endpoint))
		->toBeObject()
		->toBeInstanceOf(Response::class);
});

test('`checkForErrors()` does not throw if there are no errors', function (): void {
	Http::fake();

	expect(
		PrivateMemberAccessor::make()
			->from(resolve(GithubService::class))
			->callMethod('checkForErrors', Http::get('https://example.com'))
		)
		->toBeEmpty();
});

test('`checkForErrors()` throws if there was an issue connecting', function (): void {
	Http::fake([
		'*' => Http::response(status: 404),
	]);

	PrivateMemberAccessor::make()
		->from(resolve(GithubService::class))
		->callMethod('checkForErrors', Http::get('https://example.com'));
})->throws(RequestException::class);

test('`checkForErrors()` throws if an error was found in the response', function (): void {
	Http::fake([
		'*' => Http::response([
			'errors' => [
				['message' => 'test error message'],
			],
		]),
	]);

	PrivateMemberAccessor::make()
		->from(resolve(GithubService::class))
		->callMethod('checkForErrors', Http::get('https://example.com'));
})->throws(Exception::class, 'test error message');

it('returns a `GithubUserDTO` from `getUser()`', function (): void {
	$user = GithubUser::factory()->makeOne();

	Http::fake([
		"api.github.com/users/{$user->login}*" => Http::response(json_encode(
			GithubUserDataFactory::init()
				->withUser($user->login)
				->makeOne())),
	]);

	expect(resolve(GithubService::class)->getUser($user))
		->toBeObject()
		->toBeInstanceOf(GithubUserDTO::class);
});

it('returns a collection of `GithubUserDTO` from `getUsers()`', function (): void {
	$github = mock(GithubService::class)->makePartial();
	$github->shouldReceive('getUser')
		->andReturn(new GithubUserDTO(
			id: fake()->randomNumber(7, true),
			login: fake()->userName(),
			display_login: fake()->userName(),
			avatar_url: fake()->imageUrl(),
		));

	$users = GithubUser::factory()
		->count(2)
		->make();

	expect($github->getUsers($users))
		->toBeInstanceOf(Collection::class)
		->toHaveCount($users->count())
		->each->toBeInstanceOf(GithubUserDTO::class);
});
