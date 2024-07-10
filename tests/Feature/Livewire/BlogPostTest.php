<?php

use Livewire\Volt\Volt;
use function Pest\Laravel\get;

it('can be mounted', function () {
	$post = createPost(true);

	expectPostPublished($post);

	Volt::test('blog-post', compact('post'))->assertOk();
});

describe('blog post page', function () {
	test('renders the volt component for a published page', function () {
		$post = createPost(true);

		get("/blog/{$post->slug}")
			->assertOk()
			->assertSeeVolt('blog-post');
	});

	test('instead of rendering the blog post component, shows the 404 page for an unpublished post', function () {
		$post = createPost();

		/** @noinspection ClassnameLiteralInspection */
		get("/blog/{$post->slug}")
			->assertNotFound()
			->assertDontSee('No query results for model')
			->assertDontSee('App\Models\Post')
			->assertDontSeeVolt('blog-post');
	});
});

describe('blog post component', function () {
	test('renders a published post', function () {
		$post = createPost(true);

		Volt::test('blog-post', compact('post'))
			->assertOk()
			->assertSee($post->title);
	});

	test('throws when given an unpublished post', function () {
		$post = createPost();

		Volt::test('blog-post', compact('post'));
	})->throws(\Illuminate\View\ViewException::class);
});
