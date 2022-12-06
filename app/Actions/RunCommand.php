<?php

namespace App\Actions;

use App\Models\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends BaseAction
{
	private ?Command $command;

	/**
	 * @throws \Throwable
	 */
	public function __invoke(string $signature, array $parameters = [], ?OutputInterface $outputBuffer = null): void
	{
		$this->command = Command::firstWhere('signature', $signature);

		throw_unless($this->command, new \Exception("Command '{$signature}' is not a registered command."));

		Artisan::call($this->command->signature, $parameters, $outputBuffer);
	}
}
