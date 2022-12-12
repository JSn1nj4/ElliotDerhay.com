<?php

namespace App\Listeners;

use App\Actions\LogCommandEvent;
use App\Events\CommandWasRunEvent;
use App\Models\Command;
use App\Models\CommandEvent;

class CommandWasRun
{
    public function __construct()
    {
        //
    }

    public function handle(LogCommandEvent $logCommandEvent, CommandWasRunEvent $event): void
    {
		// TODO: determine success via individual events?

		$logCommandEvent(
			command: Command::firstWhere('signature', $event->signature),
			succeeded: true,
			message: 'Ran successfully.',
		);
    }
}
