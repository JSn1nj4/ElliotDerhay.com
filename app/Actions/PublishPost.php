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
				"Post '{$post->id}' published!",
			);
		}

		return new OperationResult(
			false,
			"Post '{$post->id}' failed to publish.",
		);
	}

	public static function execute(Post $post): OperationResult
	{
		return self::make()($post);
	}
}
