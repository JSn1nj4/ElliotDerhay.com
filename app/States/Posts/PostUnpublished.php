<?php

namespace App\States\Posts;

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
		}

		return $this->post->save() || parent::publish();
    }
}
