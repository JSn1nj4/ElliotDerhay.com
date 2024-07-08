<?php

use Livewire\Volt\Volt;

it('can be mounted', function () {
	$post = createPost(true);

	expectPostPublished($post);

	Volt::test('blog-post', compact('post'))->assertOk();
});
