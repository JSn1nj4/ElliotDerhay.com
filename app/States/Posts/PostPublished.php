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
		$this->post->published = false;

		return $this->post->save() || parent::unpublish();
	}
}
