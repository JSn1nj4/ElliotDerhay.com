<?php

namespace App\Services\Github;

use App\Contracts\GitHostService;
use App\DataTransferObjects\GithubEventDTO;
use App\DataTransferObjects\GithubUserDTO;
use App\Events\NewGithubEventTypesEvent;
use App\Models\GithubUser;
use App\Services\AbstractEndpoint;
use App\Services\Github\Endpoints\GetUserEndpoint;
use App\Services\Github\Endpoints\ListUserPublicEventsEndpoint;
use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GithubService implements GitHostService
{
	/**
	 * The recipients to notify of new GitHub event types
	 */
	private array $alertRecipients = [];

	/**
	 * Currently-supported GitHub event types
	 *
	 * Reference: https://docs.github.com/en/developers/webhooks-and-events/events/github-event-types
	 */
	private array $supportedEventTypes = [
		'CreateEvent',
		'DeleteEvent',
		'ForkEvent',
		'IssueCommentEvent',
		'IssuesEvent',
		'PublicEvent',
		'PullRequestEvent',
		'PushEvent',
		'WatchEvent',
	];

	/**
	 * The token used for interacting with the API
	 */
	private string $token;

	private Collection $unsupportedEventTypes;

	public function __construct()
	{
		foreach ([
			'services.github.token',
			'mail.to.name',
			'mail.to.address',
		] as $key) {
			if (config($key) === null) {
				throw new Exception("Config option '{$key}' not set.");
			}
		}

		$this->token = config('services.github.token');

		array_push($this->alertRecipients, [
			'name' => config('mail.to.name'),
			'email' => config('mail.to.address'),
		]);

		$this->unsupportedEventTypes = collect([]);
	}

	/**
	 * Call a specified GitHub API endpoint
	 */
	public function call(AbstractEndpoint $endpoint): Response
	{
		$endpoint_map = [
			'asForm' => [],
		];

		return with(
			Http::withHeaders($endpoint->headers),
			fn (PendingRequest $pendingRequest): PendingRequest => match (true) {
				in_array($endpoint::class, $endpoint_map['asForm']) => $pendingRequest->asForm(),
				default => $pendingRequest,
			}
		)
			->{Str::lower($endpoint->method->value)}(
				$endpoint->url(),
				$endpoint->params
			);
	}

	/**
	 * Check HTTP responses for errors
	 */
	private function checkForErrors(Response $response): void
	{
		if ($response->failed()) {
			$response->throw();
		}

		if (
			isset($response["errors"]) &&
			count($response["errors"]) >= 1
		) {
			throw new Exception($response["errors"][0]["message"]);
		}
	}

	private function eventTypeSupported(string $type): bool
	{
		if (in_array($type, $this->supportedEventTypes)) return true;

		$this->unsupportedEventTypes->push($type);

		return false;
	}

	public function filterEventTypes(Response $response): Collection
	{
		$events = collect($response->json())
			->filter(fn ($event) => $this->eventTypeSupported($event['type']))
			->transform(fn ($event) => new GithubEventDTO(
				id: $event['id'],
				type: $event['type'],
				action: GithubEventDTO::getAction($event),
				date: GithubEventDTO::getDate($event),
				user: GithubUserDTO::fromArray($event['actor']),
				source: GithubEventDTO::getEventSource($event),
				repo: $event['repo']['name'],
			));

		$this->sendNewEventTypesNotifications();

		return $events;
	}

	/**
	 * Retrieve raw events
	 */
	public function getEvents(string $user, int $count): Collection
	{
		if($count < 1) {
			throw new Exception("'\$count' value must be 1 or higher. Value is '{$count}'.");
		}

		if($count > 100) {
			throw new Exception("'\$count' value must be 100 or less. Value is '{$count}'.");
		}

		$response = $this->call(ListUserPublicEventsEndpoint::make()
			->withUser($user)
			->with([
				"Authorization" => "Bearer {$this->token}",
			], [
				'per_page' => $count,
			])
		);

		$this->checkForErrors($response);

		return $this->filterEventTypes($response);
	}

	/**
	 * Get data for a list of GitHub users
	 *
	 * This is the primary method because it mimics the GitHub REST
	 * API's behavior: getting exactly 1 user at a time.
	 */

	public function getUser(GithubUser $user): GithubUserDTO
	{
		$response = $this->call(
			GetUserEndpoint::make()
				->withUser($user->login)
				->with([
					"Authorization" => "Bearer {$this->token}",
				])
		);

		$this->checkForErrors($response);

		/**
		 * This is different than when getting GitHub events.
		 * This is because the "actor" object on a GitHub event
		 * includes the "display_login" field while the user object
		 * returned from this endpoint doesn't.
		 *
		 * Unfortunately, this means it needs to be faked here for
		 * consistency.
		 */
		return GithubUserDTO::fromArray([
			'display_login' => $response->json('login'),
			...$response->json(),
		]);
	}

	/**
	 * Get data for a group of GitHub users
	 *
	 * This is a separate method because GitHub's REST API doesn't
	 * support retrieving multiple users one a single request.
	 */
	public function getUsers(Collection $users): Collection
	{
		return $users->map([$this, 'getUser']);
	}

	private function sendNewEventTypesNotifications(): void
	{
		NewGithubEventTypesEvent::dispatchIf(
			$this->unsupportedEventTypes->count() > 0,
			$this->unsupportedEventTypes,
			$this->alertRecipients
		);
	}
}
