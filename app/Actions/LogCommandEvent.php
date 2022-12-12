<?php

namespace App\Actions;

use App\Models\Command;
use App\Models\CommandEvent;

class LogCommandEvent extends BaseAction
{
	public function __invoke(Command $command, bool $succeeded, string $message): void
	{
		CommandEvent::create([
			'command_id' => $command->id,
			'succeeded' => $succeeded,
			'message' => $message,
		]);
	}
}
