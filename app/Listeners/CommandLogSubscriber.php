<?php

namespace App\Listeners;

use App\Actions\LogCommandEvent;
use App\Events\CommandWasRunEvent;
use App\Events\GithubEventsPruned;
use App\Events\GithubEventsPulledEvent;
use App\Events\GithubUsersUpdatedEvent;
use App\Events\TokensPruned;
use App\Events\TweetsPruned;
use App\Events\TweetsPulledEvent;
use App\Events\TwitterUsersUpdatedEvent;
use App\Models\Command;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Queue\InteractsWithQueue;

class CommandLogSubscriber
{
	public function updateCommandLog(CommandWasRunEvent $event): void
	{
		// TODO: determine success via individual events?

		LogCommandEvent::make()(
			command: Command::firstWhere('signature', $event->signature),
			succeeded: true,
			message: 'Ran successfully.',
		);
	}

	public function subscribe(Dispatcher $events): array
	{
		return [
			GithubEventsPruned::class => 'updateCommandLog',
			GithubEventsPulledEvent::class => 'updateCommandLog',
			GithubUsersUpdatedEvent::class => 'updateCommandLog',
			TokensPruned::class => 'updateCommandLog',
			TweetsPruned::class => 'updateCommandLog',
			TweetsPulledEvent::class => 'updateCommandLog',
			TwitterUsersUpdatedEvent::class => 'updateCommandLog',
		];
	}
}
