<?php

use App\Events\NewGithubEventTypesEvent;
use App\Services\Github\GithubService;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Tests\Support\GithubEventDataFactory;
use Tests\Support\PrivateMemberAccessor;

beforeEach(function (): void {
	$this->api_base = 'https://api.github.com';

	$this->faker = \Faker\Factory::create();
});

it('creates an instance of App\Services\GithubService', function (): void {
	$githubService = new GithubService;

	expect($githubService)->toBeInstanceOf(GithubService::class);
});

it('throws an exception if no token is found', function (): void {
	Config::offsetUnset('services.github.token');

	new GithubService;
})->throws(Exception::class, "Config option 'services.github.token' not set.");

it('throws an exception if email recipient name is not set', function (): void {
	Config::offsetUnset('mail.to.name');

	new GithubService;
})->throws(Exception::class, "Config option 'mail.to.name' not set.");

it('throws an exception if email recipient address is not set', function (): void {
	Config::offsetUnset('mail.to.address');

	new GithubService;
})->throws(Exception::class, "Config option 'mail.to.address' not set.");

it('throws an exception if requested event count is < 1', function (): void {
	(new GithubService)->getEvents($this->faker->userName(), 0 - $this->faker->numberBetween());
})->throws(Exception::class, "'\$count' value must be 1 or higher.");

it('throws an exception if requested event count is > 100', function (): void {
	(new GithubService)->getEvents($this->faker->userName(), $this->faker->numberBetween(101));
})->throws(Exception::class, "'\$count' value must be 100 or less.");

it('processes response data received from the github events api', function (): void {
	$user = $this->faker->userName();
	$eventCount = $this->faker->numberBetween(1, 100);

	Http::fake([
		"api.github.com/users/{$user}/events/public*" =>
		Http::response(json_encode(GithubEventDataFactory::init()
			->count($eventCount)
			->make())),
	]);

	Mail::fake();

	$events = (new GithubService)->getEvents($user, $eventCount);

	expect($events)
		->toBeInstanceOf(Collection::class)
		->and(count($events))
		->toBeLessThanOrEqual($eventCount);
});

it('filters out unsupported types of github events', function (): void {
	$user = $this->faker->userName();
	$eventCount = $this->faker->numberBetween(1, 100);

	$responseData = GithubEventDataFactory::init()
			->count($eventCount)
			->make();

	Http::fake([
		"api.github.com/users/{$user}/events/public*" =>
		Http::response(json_encode($responseData)),
	]);

	Mail::fake();

	$githubService = new GithubService;

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
	$user = $this->faker->userName();
	$eventCount = $this->faker->numberBetween(1, 100);

	$githubService = new GithubService;

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
	$user = $this->faker->userName();
	$eventCount = $this->faker->numberBetween(1, 100);

	$githubService = new GithubService;

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
