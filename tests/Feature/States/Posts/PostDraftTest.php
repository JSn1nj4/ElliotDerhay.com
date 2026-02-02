<?php

use App\Enums\PostStatus;
use App\Features\PublishPostToX;
use Carbon\Carbon;

beforeEach(function () {
	$this->record = createPost()->refresh();
});

describe('a post with draft status', function () {
	test('cannot transition to draft status', function () {
		expect($this->record->status)->toEqual(PostStatus::Draft);

		$this->record->state()->draft();
	})->throws(Exception::class, 'cannot be set to draft');

	test('can transition to scheduled status', function () {
		$result = $this->record->state()->schedule(now());

		expect($result)->toBeTrue()
			->and($this->record->status)->toEqual(PostStatus::Scheduled)
			->and($this->record->scheduled_for)->toBeInstanceOf(Carbon::class);
	});

	test('can transition to published status', function () {
		// this is just for assurance
		Feature::deactivate(PublishPostToX::class);

		$result = $this->record->state()->publish();

		expect($result)->toBeTrue()
			->and($this->record->status)->toEqual(PostStatus::Published)
			->and($this->record->scheduled_for)->toBeNull();
	});
});
