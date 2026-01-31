<?php

namespace App\States\Posts;

use App\DataTransferObjects\SocialPostDTO;
use App\Enums\PostStatus;
use App\Features\PublishPostToX;
use App\Jobs\PostToXJob;
use Laravel\Pennant\Feature;

class PostDraft extends PostState
{
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
	public function schedule(): bool
	{
		return false;
	}
}
