<?php

use App\Enums\PostStatus;

beforeEach(function () {
	$this->record = createPost();
	$this->record->status = PostStatus::Published;
	$this->record->save();
});

describe('a post with published status', function () {
	test('can transition to draft status', function () {
		expect($this->record->status)->toEqual(PostStatus::Published);

		$result = $this->record->state()->draft();

		expect($result)->toBeTrue()
			->and($this->record->status)->toEqual(PostStatus::Draft)
			->and($this->record->scheduled_for)->toBeNull();
	});

	test('cannot transition to scheduled status', function () {
		expect($this->record->status)->toEqual(PostStatus::Published);

		$this->record->state()->schedule(now());
	})->throws(Exception::class, 'cannot be scheduled');

	test('cannot transition to published status', function () {
		expect($this->record->status)->toEqual(PostStatus::Published);

		$this->record->state()->publish();
	})->throws(Exception::class, 'cannot be published');
});
