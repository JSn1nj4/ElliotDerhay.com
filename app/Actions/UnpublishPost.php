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
				__("Post ':post' unpublished!", ['post' => $post->id]),
			);
		}

		return new OperationResult(
			false,
			__("Post ':post' failed to unpublish.", ['post' => $post->id]),
		);
	}

	public static function execute(Post $post): OperationResult
	{
		return self::make()($post);
	}
}
