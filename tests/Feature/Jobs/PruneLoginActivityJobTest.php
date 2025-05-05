<?php

use App\Jobs\PruneLoginActivityJob;
use App\Models\LoginActivity;
use Illuminate\Database\Eloquent\Factories\Sequence;

it('keeps all entries when below minimum number', function () {
	$minimum = config()->integer('auth.activity.min_entries');

	$createdCount = LoginActivity::factory($minimum)->create()->count();

	expect($createdCount)->toEqual($minimum, "started with {$minimum} entries");

	PruneLoginActivityJob::dispatchSync();

	expect(LoginActivity::count())->toEqual($minimum, "activity count is unchanged");
});

it('keeps all entries younger than the max age', function () {
	$minimum = config()->integer('auth.activity.min_entries');

	$createdCount = LoginActivity::factory($minimum + 10)->create()->count();

	expect($createdCount)
		->toBeGreaterThan($minimum)
		->toEqual($createdCount, "started with {$createdCount} entries");

	PruneLoginActivityJob::dispatchSync();

	expect(LoginActivity::count())
		->toBeGreaterThan($minimum)
		->toEqual($createdCount, "activity count is unchanged");
});

it('prunes entries older than max age', function () {
	$minimum = config()->integer('auth.activity.min_entries');

	$testFloor = $minimum * 2;
	$testCeiling = $testFloor + fake()->randomNumber(4);

	$now = now();
	$oldAge = now()->startOfDay()->subDays(config()->integer('auth.activity.days_to_retain') + 1);

	$createdCount = LoginActivity::factory(random_int($testFloor, $testCeiling))
		->state(new Sequence(
			['created_at' => $now],
			['created_at' => $now],
			['created_at' => $now],
			['created_at' => $oldAge],
		))
		->create()
		->count();

	expect(LoginActivity::count())
		->toBeGreaterThan($minimum)
		->toEqual($createdCount, "started with {$createdCount} entries");

	$countToRemove = LoginActivity::old()->count();

	PruneLoginActivityJob::dispatchSync();

	expect(LoginActivity::count())
		->toBeLessThan($createdCount)
		->toEqual($createdCount - $countToRemove);
})->repeat(5);

it('keeps minimum number of entries when \'minimum days worth\' rule won\'t retain enough', function () {
	$minimum = config()->integer('auth.activity.min_entries');

	$testAmount = round($minimum * 1.5);
	$now = now();
	$oldAge = now()->startOfDay()->subDays(config()->integer('auth.activity.days_to_retain') + 1);

	$createdCount = LoginActivity::factory($testAmount)
		->state(new Sequence(
			['created_at' => $now],
			['created_at' => $oldAge],
		))
		->create()
		->count();

	expect(LoginActivity::count())
		->toBeGreaterThan($minimum)
		->toEqual($createdCount, "started with {$createdCount} entries");

	$oldCount = LoginActivity::old()->count();

	// matches the actual math the prune job needs to do to stay above the minimum
	$adjustedOldCount = $oldCount + min($createdCount - $minimum - $oldCount, 0);

	PruneLoginActivityJob::dispatchSync();

	expect(LoginActivity::count())
		->toBeLessThan($createdCount)
		->toEqual($createdCount - $adjustedOldCount);
})->repeat(5);
