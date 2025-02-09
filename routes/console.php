<?php

use App\Console\Commands\{GithubEventPullCommand,
	GithubUserUpdateCommand,
	SendWeeklyReportCommand,
	TokenPruneCommand,
	TweetPullCommand,
	TwitterUserUpdateCommand};
use App\Jobs\{CleanTempStorageJob, PruneLoginActivityJob};
use Illuminate\Queue\Console\WorkCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::command(GithubEventPullCommand::class)->hourly();
Schedule::command(GithubUserUpdateCommand::class)->weekly();
Schedule::command(TokenPruneCommand::class)->daily();

Schedule::command(TweetPullCommand::class)->hourly();
Schedule::command(TwitterUserUpdateCommand::class)->weekly();

Schedule::job(CleanTempStorageJob::class)->weekly();
Schedule::job(PruneLoginActivityJob::class)->weekly();
Schedule::command(WorkCommand::class, ['--stop-when-empty'])->hourly();

// reports can run after everything else honestly
Schedule::command(SendWeeklyReportCommand::class)
	->saturdays()
	->at(config('app.schedule.default.weekly_time'));
