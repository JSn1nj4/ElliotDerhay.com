<?php

namespace App\States\Posts;

class PostPublished extends PostState
{
	/**
	 * @return bool
	 * @throws \Exception
	 */
	public function unpublish(): bool
	{
		return $this->post->update(['published' => false]) || parent::unpublish();
	}
}
