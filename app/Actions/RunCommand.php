<?php

namespace App\Actions;

use App\Models\Command;
use App\Models\CommandEvent;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends BaseAction
{
	private ?Command $command;

	private CommandEvent $event;

	public function __invoke(string $signature, array $parameters = [], ?OutputInterface $outputBuffer = null): void
	{
		$this->event = new CommandEvent();

		$this->command = Command::firstWhere('signature', $signature);

		throw_unless($this->command, new \Exception("Command '{$signature}' is not a registered command."));

		$this->event->command_id = $this->command->id;

		try {
			Artisan::call($this->command->signature, $parameters, $outputBuffer);

			$this->succeeded();
		} catch (\Exception $exception) {
			$this->failed($exception->getMessage());
		}

		$this->event->save();
	}

	private function failed(string $message): void
	{
		$this->event->succeeded = false;
		$this->event->message = $message;
	}

	private function succeeded(): void
	{
		$this->event->succeeded = true;
		$this->event->message = "Ran successfully.";
	}
}
