<?php

namespace App\Listeners;

use App\Events\CommandWasRunEvent;
use App\Models\Command;
use App\Models\CommandEvent;

class CommandWasRun
{
    public function __construct()
    {
        //
    }

    public function handle(CommandWasRunEvent $event): void
    {
		// TODO: determine success via individual events?
        CommandEvent::create([
			'command_id' => Command::firstWhere('signature', $event->signature)->id,
			'succeeded' => true,
			'message' => 'Ran successfully.',
		]);
    }
}
