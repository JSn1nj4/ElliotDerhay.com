<?php

use App\Enums\PostStatus;
use Carbon\Carbon;

beforeEach(function () {
	$this->record = createPost();
	$this->record->status = PostStatus::Scheduled;
	$this->record->scheduled_for = now();
	$this->record->save();
});

describe('a post with draft status', function () {
	test('can transition to draft status', function () {
		expect($this->record->status)->toEqual(PostStatus::Scheduled);

		$result = $this->record->state()->draft();

		expect($result)->toBeTrue()
			->and($this->record->status)->toEqual(PostStatus::Draft)
			->and($this->record->scheduled_for)->toBeNull();
	});

	test('can reschedule with a new time', function () {
		$old_schedule = $this->record->scheduled_for;
		$new_schedule = now();

		$result = $this->record->state()->schedule($new_schedule);

		expect($result)->toBeTrue()
			->and($this->record->status)->toEqual(PostStatus::Scheduled)
			->and($this->record->scheduled_for)->toBeInstanceOf(Carbon::class)
			// using Carbon's `notEqualTo()` and `equalTo()`
			->and($this->record->scheduled_for)->notEqualTo($old_schedule)
			->and($this->record->scheduled_for)->equalTo($new_schedule);
	});

	test('can transition to published status', function () {
		expect($this->record->status)->toEqual(PostStatus::Scheduled);

		$result = $this->record->state()->publish();

		expect($result)->toBeTrue()
			->and($this->record->status)->toEqual(PostStatus::Published)
			->and($this->record->scheduled_for)->toBeNull();
	});
});
