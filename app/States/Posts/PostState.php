<?php

namespace App\States\Posts;

use App\Contracts\States\PostStateContract;
use App\Models\Post;

abstract class PostState implements PostStateContract
{
	public function __construct(
		protected Post $post,
	) {}

	/**
	 * @returns bool
	 * @throws \Exception
	 */
	public function publish(): bool
	{
		throw new \Exception("Post '{$this->post->id}' cannot be published.");
	}

	/**
	 * @returns bool
	 * @throws \Exception
	 */
	public function unpublish(): bool
	{
		throw new \Exception("Post '{$this->post->id}' cannot be unpublished.");
	}
}
