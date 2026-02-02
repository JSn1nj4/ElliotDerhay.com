<?php

namespace App\Console\Commands;

use App\Enums\PostStatus;
use App\Jobs\PublishScheduledPostsJob;
use App\Models\Post;
use App\Models\Scopes\PostPublishedScope;
use Illuminate\Console\Command;

class PublishScheduledPostsCommand extends Command
{
	protected $signature = 'app:posts:publish-scheduled {--skip-queue : Bypass the queue and process scheduled posts now.}';

	protected $description = 'Check for any recently scheduled posts and attempt to publish them.';

	public function handle(): int
	{
		$this->info("Checking for scheduled posts...");

		$time = now();

		$this->line("The time is currently: {$time}");

		$count = Post::withoutGlobalScope(PostPublishedScope::class)
			->where('status', PostStatus::Scheduled)
			->where('scheduled_for', '<=', $time)
			->count();

		$this->line("Found {$count} scheduled jobs ready to publish.");

		if ($count === 0) {
			$this->info("Aborting...");
			return self::SUCCESS;
		}

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
