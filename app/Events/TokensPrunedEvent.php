<?php

namespace App\Events;

class TokensPrunedEvent extends CommandWasRunEvent
{
	public function __construct(int $statusCode, string|null $message = null)
    {
        parent::__construct('token:prune', $statusCode, $message);
    }
}
