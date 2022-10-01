<?php

namespace App\Actions;

use App\Models\{
	Category,
	Post
};

class AddCategoryToPost extends BaseAction
{
	public function __invoke(Category $category, Post $post): Post
	{
		if(!$post->categories->contains($category)) {
			$post->categories()
				->attach($category);
		}

		return $post;
	}
}
