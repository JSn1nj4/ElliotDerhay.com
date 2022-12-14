<?php

namespace App\Providers;

use App\Events\GithubEventsPruned;
use App\Events\GithubEventsPulledEvent;
use App\Events\GithubUsersUpdatedEvent;
use App\Events\NewGithubEventTypesEvent;
use App\Events\TokensPruned;
use App\Events\TweetsPruned;
use App\Events\TweetsPulledEvent;
use App\Events\TwitterUsersUpdatedEvent;
use App\Listeners\CommandWasRun;
use App\Listeners\LogLockouts;
use App\Listeners\PruneOldTweets;
use App\Listeners\SendNewGithubEventTypesEmail;
use Illuminate\Auth\Events\Lockout;
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
		GithubEventsPruned::class => [
			CommandWasRun::class,
		],
		GithubEventsPulledEvent::class => [
			CommandWasRun::class,
		],
		GithubUsersUpdatedEvent::class => [
			CommandWasRun::class,
		],
		Lockout::class => [
			LogLockouts::class,
		],
		NewGithubEventTypesEvent::class => [
			SendNewGithubEventTypesEmail::class,
		],
		Registered::class => [
			SendEmailVerificationNotification::class,
		],
		TokensPruned::class => [
			CommandWasRun::class,
		],
		TweetsPruned::class => [
			CommandWasRun::class,
		],
		TweetsPulledEvent::class => [
			PruneOldTweets::class,
			CommandWasRun::class,
		],
		TwitterUsersUpdatedEvent::class => [
			CommandWasRun::class,
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
