<?php

namespace App\Events;

class AdminInitEvent extends CommandWasRunEvent
{
    /**
     * Create a new event instance.
     */
	public function __construct(int $statusCode, string|null $message = null)
    {
        parent::__construct('admin:init', $statusCode, $message);
    }
}
