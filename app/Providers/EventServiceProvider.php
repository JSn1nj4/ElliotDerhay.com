<?php

namespace App\Providers;

use App\Events\PostPublishedEvent;
use App\Listeners\CommandLogSubscriber;
use App\Listeners\SendPostPublishedNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
	/**
	 * The event listener mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		PostPublishedEvent::class => [
			SendPostPublishedNotification::class,
		],
	];

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
