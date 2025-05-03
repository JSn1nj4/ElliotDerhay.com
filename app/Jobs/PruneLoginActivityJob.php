<?php

namespace App\Jobs;

use App\Models\LoginActivity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class PruneLoginActivityJob implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable;

	protected Builder $baseQuery;

	public function handle(): void
	{
		$this->baseQuery = LoginActivity::old();

		$totalToRemove = $this->totalToRemove();

		if ($totalToRemove <= 0) return;

		$this->baseQuery->oldest()->take($totalToRemove)->delete();
	}

	protected function totalToRemove(): int
	{
		$total = LoginActivity::count();
		$minimum = config()->integer('auth.activity.min_entries');

		// small optimization - avoid more queries
		if ($total <= $minimum) return 0;

		$agedOutTotal = $this->baseQuery->clone()->count();

		// ensure to only reduce the amount to remove if the 'old' count overlaps the minimum number
		return $agedOutTotal - max($total - $agedOutTotal - $minimum, 0);
	}
}
