<?php

namespace App\Listeners;

use App\Events\TweetsPulledEvent;
use Illuminate\Support\Facades\Artisan;

class PruneOldTweets
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
	 * @param  \App\Events\TweetsPulledEvent  $event
	 * @return void
	 */
	public function handle(TweetsPulledEvent $event)
	{
		Artisan::call('tweet:prune');
	}
}
