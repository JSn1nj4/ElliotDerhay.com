<?php

namespace App\Jobs;

use App\Models\LoginActivity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class PruneLoginActivityJob implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable;

	public function __construct() {}

	public function handle(): void
	{
		if (LoginActivity::count() <= config()->integer('auth.activity.min_entries')) {
			return;
		}

		LoginActivity::whereDate(
			'created_at',
			'<=',
			now()->startOfDay()
				->subDays(config('auth.activity.days_to_keep'))
		)->delete();
	}
}
