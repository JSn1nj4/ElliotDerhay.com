<?php

namespace App\States\Posts;

use App\DataTransferObjects\SocialPostDTO;
use App\Features\PublishPostToX;
use App\Jobs\PostToXJob;
use Laravel\Pennant\Feature;

class PostUnpublished extends PostState
{
	/**
	 * @throws \Exception
	 * @return bool
	 */
	public function publish(): bool
	{
		$this->post->published = true;

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

		return $this->post->save() || parent::publish();
	}
}
