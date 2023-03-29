<?php

use App\Actions\AddTagToPost;
use App\Models\Post;
use App\Models\Tag;

it('throws integrity constraint violation if post does not exist', function () {
	invoke(AddTagToPost::class, [
		Tag::factory()->createOne(),
		Post::factory()->makeOne(),
	]);
})->throws('Integrity constraint violation');

it('throws integrity constraint violation if tag does not exist', function () {
	invoke(AddTagToPost::class, [
		Tag::factory()->makeOne(),
		Post::factory()->createOne(),
	]);
})->throws('Integrity constraint violation');

it('adds a tag to an existing post', function () {
	$post = Post::factory()->createOne();
	$post->loadCount('tags');

	$tag = Tag::factory()->createOne();
	$tag->loadCount('posts');


	expect($post->tags_count)
		->toEqual(0)
		->and($tag->posts_count)
		->toEqual(0);
	invoke(AddTagToPost::class, [
		$tag,
		$post,
	]);

	$post->loadCount('tags');
	$post->load('tags');
	$tag->loadCount('posts');
	$tag->load('posts');

	expect($post->tags_count)
		->toEqual(1)
		->and($post->tags->contains($tag))
		->toBeTrue()
		->and($tag->posts_count)
		->toEqual(1)
		->and($tag->posts->contains($post))
		->toBeTrue();
});
