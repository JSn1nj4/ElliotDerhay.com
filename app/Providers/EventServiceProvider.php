<?php

namespace App\Providers;

use App\Events\NewGithubEventTypesEvent;
use App\Events\TweetsPulled;
use App\Listeners\PruneOldTweets;
use App\Listeners\SendNewGithubEventTypesEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
	/**
	 * The event listener mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		NewGithubEventTypesEvent::class => [
			SendNewGithubEventTypesEmail::class,
		],
		Registered::class => [
			SendEmailVerificationNotification::class,
		],
		TweetsPulled::class => [
			PruneOldTweets::class,
		],
	];

	/**
	 * Register any events for your application.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}
}
