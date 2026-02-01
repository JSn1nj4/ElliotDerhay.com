<?php

namespace App\Jobs;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\Scopes\PostPublishedScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class PublishScheduledPostsJob extends BaseQueueableJob
{
	/**
	 * Create a new job instance.
	 */
	public function __construct(
		public Carbon|\DateTime|string|null $time = null,
	) {}

	/**
	 * Execute the job.
	 */
	public function handle(): void
	{
		$time = match ($this->time) {
			null => now(),
			default => Carbon::make($this->time),
		};

		Post::withoutGlobalScope(PostPublishedScope::class)
			->where('status', PostStatus::Scheduled)
			->where('scheduled_for', '<=', $time)
			->oldest()
			->chunk(20, static function (Collection $posts) {
				/** @var Post $post */
				foreach ($posts as $post) $post->state()->publish();
			});
	}
}
