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
		throw new \Exception(__("Post ':post' cannot be published.", [
			'post' => $this->post->id,
		]));
	}

	/**
	 * @returns bool
	 * @throws \Exception
	 */
	public function unpublish(): bool
	{
		throw new \Exception(__("Post ':post' cannot be unpublished.", [
			'post' => $this->post->id,
		]));
	}
}
