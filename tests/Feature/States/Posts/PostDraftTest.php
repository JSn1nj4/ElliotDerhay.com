<?php

use App\Enums\PostStatus;
use App\Features\PublishPostToX;
use Carbon\Carbon;

describe('a post with draft status', function () {
	test('cannot transition to draft status', function () {
		$post = createPost()->refresh();

		expect($post->status)->toEqual(PostStatus::Draft);

		$post->state()->draft();
	})->throws(Exception::class, 'cannot be set to draft');

	test('can transition to scheduled status', function () {
		$post = createPost()->refresh();

		$result = $post->state()->schedule(now());

		expect($result)->toBeTrue()
			->and($post->status)->toEqual(PostStatus::Scheduled)
			->and($post->scheduled_for)->toBeInstanceOf(Carbon::class);
	});

	test('can transition to published status', function () {
		$post = createPost()->refresh();

		// this is just for assurance
		Feature::deactivate(PublishPostToX::class);

		$result = $post->state()->publish();

		expect($result)->toBeTrue()
			->and($post->status)->toEqual(PostStatus::Published)
			->and($post->scheduled_for)->toBeNull();
	});
});
