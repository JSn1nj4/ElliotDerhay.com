<?php

namespace App\States\Posts;

use App\Enums\PostStatus;

class PostPublished extends PostState
{
	/**
	 * @throws \Exception
	 * @return bool
	 */
	#[\Override]
	public function draft(): bool
	{
		$this->post->status = PostStatus::Draft;

		return $this->post->save() || parent::draft();
	}
}
