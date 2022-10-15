<?php

namespace App\Actions;

use App\Models\{
	Post,
	Tag
};

class AddTagToPost extends BaseAction
{
	public function __invoke(Tag $tag, Post $post): Post
	{
		if(!$post->tags->contains($tag)) {
			$post->tags()
				->attach($tag);
		}

		return $post;
	}
}
