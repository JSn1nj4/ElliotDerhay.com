<?php

namespace Tests\Support;

use Illuminate\Support\Arr;

class GithubEventDataFactory extends BaseFactory
{
	private array $eventTypes = [
		'CommitCommentEvent',
		'CreateEvent',
		'DeleteEvent',
		'ForkEvent',
		'GollumEvent',
		'IssueCommentEvent',
		'IssuesEvent',
		'MemberEvent',
		'PublicEvent',
		'PullRequestEvent',
		'PullRequestReviewEvent',
		'PullRequestReviewCommentEvent',
		'PushEvent',
		'ReleaseEvent',
		'SponsorshipEvent',
		'WatchEvent',
	];

	private array $extraFields = [];

	private ?array $limitedEventTypes;

	private \Faker\Generator $faker;

	public function __construct()
	{
		$this->faker = fake();
	}

	private function definition(): array
	{
		$user = $this->username ?? $this->faker->userName();
		$type = Arr::random($this->getEventTypes());

		$payload = array_merge([
			'ref' => "refs/heads/{$this->faker->slug()}",
		], match ($type) {
			'ForkEvent' => ['forkee' => [
				'full_name' => "{$user}/{$this->faker->slug}",
			]],
			'IssueCommentEvent' => ['issue' => [
				'number' => $this->faker->randomNumber(5),
			]],
			'IssuesEvent' => [
				'issue' => [
					'number' => $this->faker->randomNumber(5),
				],
				'action' => $this->faker->randomElement([
					'opened',
					'edited',
					'closed',
					'reopened',
					'assigned',
					'unassigned',
					'labeled',
					'unlabeled',
				])
			],
			'PullRequestEvent' => [
				'pull_request' => [
					'number' => $this->faker->randomNumber(5),
				],
				'action' => $this->faker->randomElement([
					'opened',
					'edited',
					'closed',
					'reopened',
					'assigned',
					'unassigned',
					'review_requested',
					'review_request_removed',
					'labeled',
					'unlabeled',
					'synchronize',
				]),
				'merged' => $this->faker->randomElement([
					null, // simulate wrapping $data['payload'] in optional()
					false,
					true,
				]),
			],
			default => [],
		});

		return [
			'id' => $this->faker->numerify('###########'),
			'actor' => GithubUserDataFactory::init()->withUser($user)->makeOne(),
			'type' => $type,
			'created_at' => now()->toDateTimeString(),
			'repo' => [
				'name' => "{$user}/{$this->faker->slug()}",
			],
			'payload' => $payload,
		];
	}

	private function getEventTypes(): array
	{
		return $this->limitedEventTypes ?? $this->eventTypes;
	}

	public function make(): array
	{
		$data = [];

		for ($i = 0; $i < $this->count; $i++) {
			array_push($data, $this->definition());
		}

		return $data;
	}

	public function makeOne(): array
	{
		return $this->definition();
	}

	public function withTypes(array $types): self
	{
		\throw_if(
			condition: count($types) <= 0,
			parameters: ['Parameter \'$types\' requires an array with at least 1 value.'],
		);

		foreach($types as $type) {
			\throw_if(
				condition: gettype($type) !== 'string',
				parameters: ['Parameter \'$types\' needs to be an array containing only strings'],
			);
		}

		\throw_if(
			condition: count(array_diff($types, $this->eventTypes)) > 0,
			parameters: ['Parameter \'$types\' must contain legal event types. Please check GitHub\'s events API for the event types it will return.'],
		);

		$this->limitedEventTypes = $types;

		return $this;
	}
}
