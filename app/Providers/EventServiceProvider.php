<?php

namespace App\Providers;

use App\Events\NewGithubEventTypesEvent;
use App\Events\TweetsPulledEvent;
use App\Listeners\PruneOldTweets;
use App\Listeners\SendNewGithubEventTypesEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
		TweetsPulledEvent::class => [
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
