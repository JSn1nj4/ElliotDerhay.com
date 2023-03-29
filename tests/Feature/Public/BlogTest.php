<?php

it('loads the blog page', function () {
    $this->get(route('blog'))->assertStatus(200);
});

it('loads a post view page for an existing blog post', function () {
	$this->get(route('blog.show', [
		'post' => \App\Models\Post::factory()->createOne()
	]))->assertStatus(200);
});

it('returns a 404 error for a non-existent blog post', function () {
	$this->get(route('blog.show', ['post' => \App\Models\Post::factory()->makeOne()]))
		->assertStatus(404);
});
