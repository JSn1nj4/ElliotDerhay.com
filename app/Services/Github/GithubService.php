<?php

namespace App\Services\Github;

use App\Contracts\GitHostService;
use App\DataTransferObjects\GithubEventDTO;
use App\DataTransferObjects\GithubUserDTO;
use App\Events\NewGithubEventTypesEvent;
use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class GithubService implements GitHostService
{
	/**
	 * The base GitHub API URL
	 */
	private string $api_url = 'https://api.github.com';

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
	 *
	 * @todo: check for error message
	 */
	public function getEvents(string $user, int $count): Collection
	{
		if($count < 1) {
			throw new Exception("'\$count' value must be 1 or higher. Value is '{$count}'.");
		}

		if($count > 100) {
			throw new Exception("'\$count' value must be 100 or less. Value is '{$count}'.");
		}

		$response = Http::withToken($this->token)
			->withHeaders([
				"Accept" => "application/vnd.github.v3+json",
				"User-Agent" =>  "Elliot-Derhay-App",
			])->get($this->getUrl("users/{$user}/events/public"), [
				'per_page' => $count
			]);

		return $this->filterEventTypes($response);
	}

	/**
	 * Return GitHub API URL
	 */
	public function getUrl(string $url): string
	{
		return "{$this->api_url}/{$url}";
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
