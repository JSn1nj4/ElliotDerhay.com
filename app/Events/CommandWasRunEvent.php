<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

abstract class CommandWasRunEvent
{
    use Dispatchable;

	public readonly string $message;

	protected array $defaultMessages = [
		0 => 'Command ran successfully.',
		1 => 'Command run failed.',
	];

    public function __construct(
		public readonly string $signature,
		public readonly int $exitCode,
		string|null $message = null,
	)
    {
		$this->message = $message ?? $this->defaultMessages[$this->exitCode];
    }
}
