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
        return $this->post->update([
			'published' => true,
			'published_at' => $this->post->published_at ?? now(),
		]) || parent::publish();
    }
}
