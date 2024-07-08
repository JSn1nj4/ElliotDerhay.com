<?php

use Livewire\Volt\Volt;

it('can be mounted', function () {
	$post = createPost(true);

	expect($post->published)
		->toBeTrue('Testing "published" field')
		->and($post->published_at)
		->toBeInstanceOf(\Carbon\Carbon::class, 'Testing "published_at" field');

	Volt::test('blog-post', compact('post'))->assertOk();
});
