<?php

namespace App\Events;

use Illuminate\Support\Collection;
use Illuminate\Foundation\Events\Dispatchable;

class NewGithubEventTypesEvent
{
    use Dispatchable;

    public function __construct(
		public Collection $newEventTypes,
		public array $emailRecipients,
	)
    {
        //
    }
}
