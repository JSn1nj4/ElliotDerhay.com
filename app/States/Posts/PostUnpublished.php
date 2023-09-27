<?php

namespace App\States\Posts;

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

			PostToXJob::dispatchIf(
				Feature::active(PublishPostToX::class),
				$this->post->getPostable(),
			);
		}

		return $this->post->save() || parent::publish();
	}
}
