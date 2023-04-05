<?php

namespace App\Providers;

use App\Events\GithubEventsPruned;
use App\Events\GithubEventsPulledEvent;
use App\Events\GithubUsersUpdatedEvent;
use App\Events\NewGithubEventTypesEvent;
use App\Events\TokensPrunedEvent;
use App\Events\TweetsPrunedEvent;
use App\Events\TweetsPulledEvent;
use App\Events\TwitterUsersUpdatedEvent;
use App\Listeners\CommandLogSubscriber;
use App\Listeners\SendPasswordChangedNotification;
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
	protected $listen = [];

	/**
	 * Subscribers to handle multiple related events
	 *
	 * @var array
	 */
	protected $subscribe = [
		CommandLogSubscriber::class,
	];

	/**
	 * Register any events for your application.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		//
	}

	public function shouldDiscoverEvents(): bool
	{
		return true;
	}
}
