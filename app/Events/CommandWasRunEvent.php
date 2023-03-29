<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

abstract class CommandWasRunEvent
{
    use Dispatchable;

    public function __construct(
		public readonly ?string $signature,
	)
    {
		//
    }
}
