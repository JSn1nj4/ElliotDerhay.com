<?php

namespace App\Events;

use Illuminate\Support\Collection;
use Illuminate\Foundation\Events\Dispatchable;

class NewGithubEventTypesEvent
{
    use Dispatchable;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Collection $newEventTypes, array $emailRecipients)
    {
        $this->newEventTypes = $newEventTypes;

		$this->emailRecipients = $emailRecipients;
    }
}
