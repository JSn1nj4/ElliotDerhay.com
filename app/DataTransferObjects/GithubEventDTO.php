<?php

namespace App\DataTransferObjects;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class GithubEventDTO extends DataTransferObject
{
	public string $id;

	public string $type;

	public ?string $action;

	public string $date;

	public GithubUserDTO $user;

	public ?string $source;

	public string $repo;

	public static function getAction(array $data): ?string
	{
		return match ($data['type']) {
			'IssuesEvent' => \optional($data['payload'])['action'],
			'PullRequestEvent' => (\optional($data['payload'])['merged']
				? 'merged'
				: \optional($data['payload'])['action']),
			default => null,
		};
	}

	public static function getEventSource(array $data): ?string
	{
		return match ($data['type']) {
			'CreateEvent', 'DeleteEvent', 'PushEvent' 	=> $data['payload']['ref'],
			'ForkEvent' 								=> $data['payload']['forkee']['full_name'],
			'IssueCommentEvent', 'IssuesEvent' 			=> $data['payload']['issue']['number'],
			'PullRequestEvent' 							=> $data['payload']['pull_request']['number'],
			default => null,
		};
	}

	public static function getDate(array $eventData): string
	{
		return Carbon::make($eventData['created_at'])->format('Y-m-d H:i:s');
	}
}
