<?php

use Tests\Support\GithubEventDataFactory;

dataset('github_event_data_one', [
	[GithubEventDataFactory::init()->makeOne()],
]);

dataset('github_event_sources', [
	['CommitCommentEvent', null],
	['CreateEvent', 'payload,ref'],
	['DeleteEvent', 'payload,ref'],
	['ForkEvent', 'payload,forkee,full_name'],
	['GollumEvent', null],
	['IssueCommentEvent', 'payload,issue,number'],
	['IssuesEvent', 'payload,issue,number'],
	['MemberEvent', null],
	['PublicEvent', null],
	['PullRequestEvent', 'payload,pull_request,number'],
	['PullRequestReviewEvent', null],
	['PullRequestReviewCommentEvent', null],
	['PushEvent', 'payload,ref'],
	['ReleaseEvent', null],
	['SponsorshipEvent', null],
	['WatchEvent', null],
]);

dataset('github_event_actions', [
	['CommitCommentEvent', null],
	['CreateEvent', null],
	['DeleteEvent', null],
	['ForkEvent', null],
	['GollumEvent', null],
	['IssueCommentEvent', null],
	['IssuesEvent', [
		'opened',
		'edited',
		'closed',
		'reopened',
		'assigned',
		'unassigned',
		'labeled',
		'unlabeled',
	]],
	['MemberEvent', null],
	['PublicEvent', null],
	['PullRequestEvent', [
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
		'merged',
	]],
	['PullRequestReviewEvent', null],
	['PullRequestReviewCommentEvent', null],
	['PushEvent', null],
	['ReleaseEvent', null],
	['SponsorshipEvent', null],
	['WatchEvent', null],
]);
