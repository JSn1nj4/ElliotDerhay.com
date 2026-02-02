<?php

namespace App\States\Posts;

use App\DataTransferObjects\SocialPostDTO;
use App\Enums\PostStatus;
use App\Features\PublishPostToX;
use App\Jobs\PostToXJob;
use Carbon\Carbon;
use Laravel\Pennant\Feature;

class PostScheduled extends PostState
{
	#[\Override]
	public function draft(): bool
	{
		$this->post->status = PostStatus::Draft;

		$this->post->scheduled_for = null;

		return $this->post->save() || parent::draft();
	}

	/**
	 * @throws \Exception
	 * @return bool
	 */
	#[\Override]
	public function publish(): bool
	{
		$this->post->status = PostStatus::Published;

		if (!$this->post->published_at) {
			$this->post->published_at = now();

			$postable = $this->post->getPostable();

			PostToXJob::dispatchIf(
				Feature::active(PublishPostToX::class),

				new SocialPostDTO(
					$postable->text,
					links: $postable->links,
					tags: $postable->tags,
				),
			);
		}

		$this->post->scheduled_for = null;

		return $this->post->save() || parent::publish();
	}

	#[\Override]
	public function schedule(Carbon|\DateTime|string $time): bool
	{
		$this->post->status = PostStatus::Scheduled;

		$this->post->scheduled_for = Carbon::make($time);

		return $this->post->save() || parent::schedule($time);
	}
}
