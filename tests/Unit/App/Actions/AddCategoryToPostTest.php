<?php

use App\Actions\AddCategoryToPost;
use App\Models\Category;
use App\Models\Post;

it('throws integrity constraint violation if post does not exist', function () {
	invoke(AddCategoryToPost::class, [
		Category::factory()->createOne(),
		Post::factory()->makeOne(),
	]);
})->throws('Integrity constraint violation');

it('throws integrity constraint violation if category does not exist', function () {
	invoke(AddCategoryToPost::class, [
		Category::factory()->makeOne(),
		Post::factory()->createOne(),
	]);
})->throws('Integrity constraint violation');

it('adds a category to an existing post', function () {
	$post = Post::factory()->createOne();
	$post->loadCount('categories');

	$category = Category::factory()->createOne();
	$category->loadCount('posts');


	expect($post->categories_count)
		->toEqual(0)
		->and($category->posts_count)
		->toEqual(0);

	invoke(AddCategoryToPost::class, [
		$category,
		$post,
	]);

	$post->loadCount('categories');
	$post->load('categories');
	$category->loadCount('posts');
	$category->load('posts');

	expect($post->categories_count)
		->toEqual(1)
		->and($post->categories->contains($category))
		->toBeTrue()
		->and($category->posts_count)
		->toEqual(1)
		->and($category->posts->contains($post))
		->toBeTrue();
});
