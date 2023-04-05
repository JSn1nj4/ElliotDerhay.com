<?php

namespace App\Events;

class TweetsPrunedEvent extends CommandWasRunEvent
{
	public function __construct(int $statusCode, string|null $message = null)
    {
        parent::__construct('tweet:prune', $statusCode, $message);
    }
}
