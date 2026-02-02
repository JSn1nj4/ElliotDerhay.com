<?php

use App\Features\BlogIndex;
use Laravel\Pennant\Feature;
use function Pest\Laravel\get;

beforeEach(fn () => Feature::define(BlogIndex::class, true));

livewireMountable('lightbox');

test('blog renders the volt component')
	->get('/blog')
	->assertOk()
	->assertSeeLivewire('lightbox');

test('published blog post renders the volt component', function () {
	$post = createPost(true);

	get("/blog/{$post->slug}")
		->assertOk()
		->assertSeeLivewire('lightbox');
});
