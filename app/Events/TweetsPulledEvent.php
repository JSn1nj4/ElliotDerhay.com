<?php

namespace App\Events;

class TweetsPulledEvent extends CommandWasRunEvent
{
	public function __construct(int $statusCode, string|null $message = null)
	{
		parent::__construct('tweet:pull', $statusCode, $message);
	}
}
