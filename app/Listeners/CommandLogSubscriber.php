<?php

namespace App\Listeners;

use App\Actions\LogCommandEvent;
use App\Enums\CommandExitCode;
use App\Events\AdminInitEvent;
use App\Events\AdminSetPasswordEvent;
use App\Events\CommandWasRunEvent;
use App\Events\GithubEventsPruned;
use App\Events\GithubEventsPulledEvent;
use App\Events\GithubUsersUpdatedEvent;
use App\Models\Command;
use Illuminate\Events\Dispatcher;

class CommandLogSubscriber
{
	public function updateCommandLog(CommandWasRunEvent $event): void
	{
		// TODO: determine success via individual events?

		LogCommandEvent::make()(
			command: Command::firstWhere('signature', $event->signature),
			succeeded: $event->exitCode === CommandExitCode::SUCCESS->value,
			message: $event->message,
		);
	}

	public function subscribe(Dispatcher $events): array
	{
		return [
			AdminInitEvent::class => 'updateCommandLog',
			AdminSetPasswordEvent::class => 'updateCommandLog',
			GithubEventsPruned::class => 'updateCommandLog',
			GithubEventsPulledEvent::class => 'updateCommandLog',
			GithubUsersUpdatedEvent::class => 'updateCommandLog',
		];
	}
}
