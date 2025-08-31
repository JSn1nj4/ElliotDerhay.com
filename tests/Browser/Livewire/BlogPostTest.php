<?php

use App\Features\BlogIndex;
use Laravel\Pennant\Feature;
use Livewire\Volt\Volt;
use function Pest\Laravel\get;

beforeEach(fn () => Feature::define(BlogIndex::class, true));

it('can be mounted', function () {
	$post = createPost(true);

	expectPostPublished($post);

	Volt::test('blog.post', compact('post'))->assertOk();
});

describe('blog post page', function () {
	test('renders the volt component for a published page', function () {
		$post = createPost(true);

		get("/blog/{$post->slug}")
			->assertOk()
			->assertSeeVolt('blog.post');
	});

	test('shows the 404 page for an unpublished post', function () {
		$post = createPost();

		get("/blog/{$post->slug}")
			->assertNotFound()
			->assertSee('No query results for model')
			->assertSee("[App\\Models\\Post] {$post->slug}")
			->assertDontSeeVolt('blog.post');

		Config::set('app.env', 'production');

		get("/blog/{$post->slug}")
			->assertNotFound()
			->assertSee('Not Found')
			->assertDontSee('No query results for model')
			->assertDontSee("[App\\Models\\Post] {$post->slug}")
			->assertDontSeeVolt('blog.post');
	});
});

describe('blog post component', function () {
	test('renders a published post', function () {
		$post = createPost(true);

		Volt::test('blog.post', compact('post'))
			->assertOk()
			->assertSee($post->title);
	});

	test('throws when given an unpublished post', function () {
		$post = createPost();

		Volt::test('blog.post', compact('post'));
	})->throws(\Illuminate\View\ViewException::class);
});
