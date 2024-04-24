<?php

use App\Console\Commands\{GithubEventPullCommand,
	GithubUserUpdateCommand,
	SendWeeklyReportCommand,
	TokenPruneCommand,
	TweetPullCommand,
	TwitterUserUpdateCommand};
use App\Features\TwitterFeed;
use App\Jobs\CleanTempStorageJob;
use Illuminate\Queue\Console\WorkCommand;
use Illuminate\Support\Facades\Schedule;
use Laravel\Pennant\Feature;

Schedule::command(GithubEventPullCommand::class)->hourly();
Schedule::command(GithubUserUpdateCommand::class)->weekly();
Schedule::command(TokenPruneCommand::class)->daily();

if (Feature::active(TwitterFeed::class)) {
	Schedule::command(TweetPullCommand::class)->hourly();
	Schedule::command(TwitterUserUpdateCommand::class)->weekly();
}

Schedule::job(CleanTempStorageJob::class)->weekly();
Schedule::command(WorkCommand::class, ['--stop-when-empty'])->daily();

// reports can run after everything else honestly
Schedule::command(SendWeeklyReportCommand::class)
	->saturdays()
	->at(config('app.schedule.default.weekly_time'));
