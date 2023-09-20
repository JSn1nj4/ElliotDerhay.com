<?php

namespace App\States\Posts;

use App\Jobs\PostToXJob;

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

			PostToXJob::dispatch($this->post->getPostable());
		}

		return $this->post->save() || parent::publish();
	}
}
