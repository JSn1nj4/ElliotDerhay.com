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
use App\Listeners\SendPasswordChangedNotification;
use App\Listeners\UpdateCommandLog;
use App\Listeners\LogLockouts;
use App\Listeners\PruneOldTweets;
use App\Listeners\SendNewGithubEventTypesEmail;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\PasswordReset;
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
			UpdateCommandLog::class,
		],
		GithubEventsPulledEvent::class => [
			UpdateCommandLog::class,
		],
		GithubUsersUpdatedEvent::class => [
			UpdateCommandLog::class,
		],
		Lockout::class => [
			LogLockouts::class,
		],
		NewGithubEventTypesEvent::class => [
			SendNewGithubEventTypesEmail::class,
		],
		PasswordReset::class => [
			SendPasswordChangedNotification::class,
		],
		Registered::class => [
			SendEmailVerificationNotification::class,
		],
		TokensPruned::class => [
			UpdateCommandLog::class,
		],
		TweetsPruned::class => [
			UpdateCommandLog::class,
		],
		TweetsPulledEvent::class => [
			PruneOldTweets::class,
			UpdateCommandLog::class,
		],
		TwitterUsersUpdatedEvent::class => [
			UpdateCommandLog::class,
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
