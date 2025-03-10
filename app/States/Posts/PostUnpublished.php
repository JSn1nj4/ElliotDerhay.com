<?php

namespace App\States\Posts;

use App\DataTransferObjects\SocialPostDTO;
use App\Features\PublishPostToX;
use App\Jobs\PostToXJob;
use Laravel\Pennant\Feature;

class PostUnpublished extends PostState
{
	/**
	 * @return bool
	 * @throws \Exception
	 */
	public function publish(): bool
	{
		$this->post->published = true;

		if (!$this->post->published_at) {
			$this->post->published_at = now();

			$postable = $this->post->getPostable();

			PostToXJob::dispatchIf(
				Feature::active(PublishPostToX::class),

				// reformatted especially for non-external-link-friendly platforms 🫠
				new SocialPostDTO(
					"{$postable->text}\n(Link in replies 🔗)",
					tags: $postable->tags,
					subpost: new SocialPostDTO(links: $postable->links)),
			);
		}

		return $this->post->save() || parent::publish();
	}
}
