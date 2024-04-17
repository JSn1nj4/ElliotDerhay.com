<?php

namespace App\DataTransferObjects;

use Illuminate\Support\Carbon;

readonly class GithubEventDTO
{
	public function __construct(
		public string        $id,
		public string        $type,
		public string|null   $action,
		public string        $date,
		public GithubUserDTO $user,
		public string|null   $source,
		public string        $repo,
	) {}

	public static function getAction(array $data): string|null
	{
		return match ($data['type']) {
			'CommitCommentEvent' => match (optional($data['payload'])['action']) {
				'created' => 'commented on',
				default => 'deleted a comment on',
			},

			'IssuesEvent' => optional($data['payload'])['action'],

			'PullRequestEvent' => match (true) {
				optional($data['payload'])['merged'] !== null => 'merged',
				default => optional($data['payload'])['action'],
			},

			'PullRequestReviewCommentEvent' => match (optional($data['payload'])['action']) {
				'created' => 'commented on a review of',
				'deleted' => 'deleted a review comment on',
				default => 'updated a review comment on',
			},

			'PullRequestReviewEvent' => 'started a review on',

			'ReleaseEvent' => match (optional($data['payload'])['action']) {
				null => 'updated',
				default => optional($data['payload'])['action'],
			},

			default => null,
		};
	}

	public static function getEventSource(array $data): string|null
	{
		return match ($data['type']) {
			'CommitCommentEvent' => $data['payload']['comment']['commit_id'],
			'CreateEvent', 'DeleteEvent', 'PushEvent' => $data['payload']['ref'],
			'ForkEvent' => $data['payload']['forkee']['full_name'],
			'IssueCommentEvent', 'IssuesEvent' => $data['payload']['issue']['number'],
			'PullRequestEvent',
			'PullRequestReviewCommentEvent',
			'PullRequestReviewEvent' => $data['payload']['pull_request']['number'],
			'ReleaseEvent' => $data['payload']['release']['html_url'],
			default => null,
		};
	}

	public static function getDate(array $eventData): string
	{
		return Carbon::make($eventData['created_at'])->format('Y-m-d H:i:s');
	}
}
