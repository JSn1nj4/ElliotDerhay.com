<?php

namespace App\Actions;

use App\DataTransferObjects\OperationResult;
use App\Models\Post;

class PublishPost extends BaseAction
{
	public function __invoke(Post $post): OperationResult
	{
		if ($post->update(['published' => true])) {
			return new OperationResult(
				true,
				__("Post ':post' published!", ['post' => $post->id]),
			);
		}

		return new OperationResult(
			false,
			__("Post ':post' failed to publish.", ['post' => $post->id]),
		);
	}

	public static function execute(Post $post): OperationResult
	{
		return self::make()($post);
	}
}
