<?php

namespace App\Events;

class AdminSetPasswordEvent extends CommandWasRunEvent
{
    /**
     * Create a new event instance.
     */
	public function __construct(int $statusCode, string|null $message = null)
	{
		parent::__construct('admin:reset_password', $statusCode, $message);
	}
}
