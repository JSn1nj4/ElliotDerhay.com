<?php

use App\DataTransferObjects\GithubEventDTO;
use App\DataTransferObjects\GithubUserDTO;
use Illuminate\Support\Carbon;
use Tests\Support\GithubEventDataFactory;

it('creates a GithubEventDTO')
	->with('github_event_data_one')
	->expect(fn ($data) => new GithubEventDTO(
		$data['id'],
		$data['type'],
		GithubEventDTO::getAction($data),
		GithubEventDTO::getDate($data),
		GithubUserDTO::fromArray($data['actor']),
		GithubEventDTO::getEventSource($data),
		$data['repo']['name'],
	))
	->toBeInstanceOf(GithubEventDTO::class);

test('\'getAction\' returns the correct \'action\' value', function (string $type, array|string|null $returns) {
	$event = GithubEventDataFactory::init()
		->withTypes([$type])
		->makeOne();

	$action = GithubEventDTO::getAction($event);

	expect($action)
		->when(is_array($returns), fn ($action) => $action->toBeIn($returns))
		->unless(is_array($returns), fn ($action) => $action->toBe($returns));
})->with('github_event_actions');

test('\'getEventSource\' returns the correct event source', function (string $type, string|null $path) {
	$event = GithubEventDataFactory::init()
		->withTypes([$type])
		->makeOne();

	expect(GithubEventDTO::getEventSource($event))
		->when(is_null($path), fn ($result) => $result->toBe($path))
		->unless(is_null($path), function ($result) use ($event, $path) {
			$value = array_reduce(
				explode(',', $path),
				fn ($current, $next) => $current[$next],
				$event
			);

			$result->toBe("$value");
		});
})->with('github_event_sources');

test('\'getDate\' returns the correct date format', function () {
	$event = GithubEventDataFactory::init()->makeOne();

	expect(GithubEventDTO::getDate($event))
		->toBe(Carbon::make($event['created_at'])
			->format('Y-m-d H:i:s'));
});
