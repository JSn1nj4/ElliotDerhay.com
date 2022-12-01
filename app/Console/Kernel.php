<?php

namespace App\Console;

use App\Console\Commands\GithubEventPullCommand;
use App\Console\Commands\GithubUserUpdateCommand;
use App\Console\Commands\TokenPruneCommand;
use App\Console\Commands\TweetPullCommand;
use App\Console\Commands\TwitterUserUpdateCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$schedule->command(GithubEventPullCommand::class)->hourly();
		$schedule->command(GithubUserUpdateCommand::class)->weekly();
		$schedule->command(TokenPruneCommand::class)->daily();
		$schedule->command(TweetPullCommand::class)->hourly();
		$schedule->command(TwitterUserUpdateCommand::class)->weekly();
	}

	/**
	 * Register the commands for the application.
	 *
	 * @return void
	 */
	protected function commands()
	{
		$this->load(__DIR__.'/Commands');

		require base_path('routes/console.php');
	}
}
