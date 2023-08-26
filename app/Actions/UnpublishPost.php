<?php

namespace App\Actions;

use App\DataTransferObjects\OperationResult;
use App\Models\Post;

class UnpublishPost extends BaseAction
{
	public function __invoke(Post $post): OperationResult
	{
		if ($post->update(['published' => false])) {
			return new OperationResult(
				true,
				"Post '{$post->id}' unpublished!",
			);
		}

		return new OperationResult(
			false,
			"Post '{$post->id}' failed to unpublish.",
		);
	}

	public static function execute(Post $post): OperationResult
	{
		return self::make()($post);
	}
}
