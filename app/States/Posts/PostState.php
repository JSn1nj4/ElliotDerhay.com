<?php

namespace App\States\Posts;

use App\Contracts\States\PostStateContract;
use App\Models\Post;
use Carbon\Carbon;

abstract class PostState implements PostStateContract
{
	public function __construct(
		protected Post $post,
	) {}

	/**
	 * @returns bool
	 * @throws \Exception
	 */
	public function draft(): bool
	{
		throw new \Exception(__("Post ':post' cannot be set to draft.", [
			'post' => $this->post->id,
		]));
	}

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
	 * @param \App\States\Posts\Carbon|\DateTime|null $time
	 * @returns bool
	 * @throws \Exception
	 */
	public function schedule(Carbon|\DateTime|string $time): bool
	{
		throw new \Exception(__("Post ':post' cannot be scheduled.", [
			'post' => $this->post->id,
		]));
	}
}
