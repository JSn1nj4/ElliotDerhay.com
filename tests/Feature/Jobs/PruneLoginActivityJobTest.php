<?php

use App\Jobs\PruneLoginActivityJob;
use App\Models\LoginActivity;
use Illuminate\Database\Eloquent\Factories\Sequence;

it('keeps all entries when below minimum number', function () {
	/**
	 * this can be tested simply by
	 * - creating the minimum number of entries and making sure none get pruned, and
	 * - creating less than the minimum and making sure none of them get pruned
	 */

	$minimum = config()->integer('auth.activity.min_entries');

	$createdCount = LoginActivity::factory($minimum)->create()->count();

	expect($createdCount)->toEqual($minimum, "started with {$minimum} entries");

	PruneLoginActivityJob::dispatchSync();

	expect(LoginActivity::count())->toEqual($minimum, "activity count is unchanged");
});

it('keeps all entries younger than the max age', function () {
	/**
	 * this can be tested by simply
	 * - creating more entries than the minimum number
	 * - making sure none of them get pruned
	 */

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
})->wip();

it('keeps minimum number of entries when \'minimum days worth\' rule won\'t retain enough', function () {
	/**
	 * this can be tested by doing 2 things
	 * - creating slightly more entries than the minimum number
	 * - setting half of the entries to older than the max age
	 */
})->wip();
