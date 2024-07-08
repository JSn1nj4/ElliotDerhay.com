<?php

use Livewire\Volt\Volt;
use function Pest\Laravel\get;

voltMountable('blog-index');

it('renders posts that are published', function () {
	$posts = createPosts(10, true);

	Volt::test('blog-index')
		->assertOk()
		->assertSee($posts->get('title'))
		->assertSee($posts->get('excerpt'))
		->assertSee('Read More');

	// for some reason this needs to be called after doing the actual volt test
	get('/blog')
		->assertOk()
		->assertSeeVolt('blog-index');
});
