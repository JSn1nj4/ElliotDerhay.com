<?php

namespace App\Listeners;

use App\Events\GithubEventsPulledEvent;
use Illuminate\Support\Facades\Artisan;

class PruneOldGithubEvents
{
	/**
	 * Create the event listener.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  object  $event
	 * @return void
	 */
	public function handle(GithubEventsPulledEvent $event)
	{
		Artisan::call('github:event:prune');
	}
}
