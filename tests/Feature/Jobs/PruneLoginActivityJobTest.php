<?php

use App\Jobs\PruneLoginActivityJob;
use App\Models\LoginActivity;

it('prunes old login activity', function () {
	$removed_count = LoginActivity::factory(fake()->randomDigitNot(0))
			->state(['created_at' => now()->subDays(
				config('auth.activity.days_to_keep') + 1,
			)])
			->create()->count()

		+ LoginActivity::factory(fake()->randomDigitNot(0))
			->state(['created_at' => now()->subDays(
				config('auth.activity.days_to_keep'),
			)])
			->create()->count();

	$remaining_count = LoginActivity::factory(fake()->randomDigitNot(0))
		->state(['created_at' => now()->subDays(
			config('auth.activity.days_to_keep') - 1,
		)])
		->create()->count();

	expect(LoginActivity::count())
		->toEqual($removed_count + $remaining_count)
		->toBeGreaterThan($remaining_count);

	PruneLoginActivityJob::dispatchSync();

	$activity = LoginActivity::all();

	expect($activity->count())
		->toEqual($remaining_count)
		->toBeLessThan($removed_count + $remaining_count);

	$activity->each(fn (LoginActivity $item) => assert(now()
		->subDays(config('auth.activity.days_to_keep'))
		->lessThan($item->created_at)));
});
