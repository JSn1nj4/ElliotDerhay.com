<?php

use Livewire\Volt\Volt;

voltMountable('blog-index');

test('blog page renders the volt component')
	->get('/blog')
	->assertOk()
	->assertSeeVolt('blog-index');

describe('post index component', function () {
	test('does render published posts', function () {
		$posts = createPosts(10, true);

		$posts->each(fn ($post) => expectPostPublished($post));

		Volt::test('blog-index')
			->assertOk()
			->assertSee($posts->get('title'))
			->assertSee($posts->get('excerpt'))
			->assertSee('Read More');
	});

	test('does not render unpublished posts', function () {
		$posts = createPosts(10);

		$posts->each(fn ($post) => expectPostNotPublished($post));

		Volt::test('blog-index')
			->assertOk()
			->assertDontSee($posts->get('title'))
			->assertDontSee($posts->get('excerpt'))
			->assertDontSee('Read More');
	});
});
