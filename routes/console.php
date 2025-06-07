<?php

use App\Console\Commands\{GithubEventPullCommand, GithubUserUpdateCommand, SendWeeklyReportCommand, TokenPruneCommand};
use App\Jobs\{CleanTempStorageJob, PruneLoginActivityJob};
use Illuminate\Queue\Console\WorkCommand;
use Illuminate\Support\Facades\Schedule;
use Spatie\Backup\Commands\BackupCommand;
use Spatie\Backup\Commands\CleanupCommand;

Schedule::command(GithubEventPullCommand::class)->hourly();
Schedule::command(GithubUserUpdateCommand::class)->weekly();
Schedule::command(TokenPruneCommand::class)->daily();

Schedule::job(CleanTempStorageJob::class)->weekly();
Schedule::job(PruneLoginActivityJob::class)->weekly();
Schedule::command(WorkCommand::class, ['--stop-when-empty'])->hourly();

// backup scheduling
Schedule::command(BackupCommand::class, ['--only-db'])
	->daily()
	->at(config('app.schedule.default.daily_time'))
	->after(fn () => Artisan::call(CleanupCommand::class));

// reports can run after everything else honestly
Schedule::command(SendWeeklyReportCommand::class)
	->saturdays()
	->at(config('app.schedule.default.weekly_time'));
