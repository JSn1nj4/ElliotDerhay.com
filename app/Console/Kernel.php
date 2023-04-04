<?php

namespace App\Console;

use App\Console\Commands\GithubEventPullCommand;
use App\Console\Commands\GithubUserUpdateCommand;
use App\Console\Commands\TokenPruneCommand;
use App\Console\Commands\TweetPullCommand;
use App\Console\Commands\TwitterUserUpdateCommand;
use App\Features\TwitterFeed;
use App\Jobs\CleanTempStorageJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Queue\Console\WorkCommand;
use Illuminate\Queue\Queue;
use Laravel\Pennant\Feature;

class Kernel extends ConsoleKernel
{
	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		//
	];

	/**
	 * Define the application's command schedule.
	 */
	protected function schedule(Schedule $schedule): void
	{
		$schedule->command(GithubEventPullCommand::class)->hourly();
		$schedule->command(GithubUserUpdateCommand::class)->weekly();
		$schedule->command(TokenPruneCommand::class)->daily();

		if (Feature::active(TwitterFeed::class)) {
			$schedule->command(TweetPullCommand::class)->hourly();
			$schedule->command(TwitterUserUpdateCommand::class)->weekly();
		}

		$schedule->job(CleanTempStorageJob::class)->weekly();
		$schedule->command(WorkCommand::class, ['--stop-when-empty'])->daily();
	}

	/**
	 * Register the commands for the application.
	 */
	protected function commands(): void
	{
		$this->load(__DIR__.'/Commands');

		require base_path('routes/console.php');
	}
}
