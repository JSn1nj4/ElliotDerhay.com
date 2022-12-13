<?php

namespace App\Listeners;

use App\Actions\LogCommandEvent;
use App\Events\CommandWasRunEvent;
use App\Models\Command;

class CommandWasRun
{
    public function __construct()
    {
        //
    }

    public function handle(CommandWasRunEvent $event): void
    {
		// TODO: determine success via individual events?

		LogCommandEvent::make()(
			command: Command::firstWhere('signature', $event->signature),
			succeeded: true,
			message: 'Ran successfully.',
		);
    }
}
