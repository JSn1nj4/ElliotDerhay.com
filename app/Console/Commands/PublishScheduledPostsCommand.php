<?php

namespace App\Console\Commands;

use App\Jobs\PublishScheduledPostsJob;
use Illuminate\Console\Command;

class PublishScheduledPostsCommand extends Command
{
	protected $signature = 'app:posts:publish-scheduled {--skip-queue : Bypass the queue and process scheduled posts now.}';

	protected $description = 'Check for any recently scheduled posts and attempt to publish them.';

	public function handle(): int
	{
		$time = now();

		$this->line("{$time}: Prepareing to process scheduled posts.");

		if ($this->option('skip-queue')) {
			$this->info("Processing scheduled jobs now...");

			PublishScheduledPostsJob::dispatchSync(time: $time);

			$this->info("Finished!");

			return self::SUCCESS;
		}

		PublishScheduledPostsJob::dispatch(time: $time);

		$this->info("Dispatched publishing job.");

		return self::SUCCESS;
	}
}
