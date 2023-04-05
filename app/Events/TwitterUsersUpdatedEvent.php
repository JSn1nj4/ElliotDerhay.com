<?php

namespace App\Events;

class TwitterUsersUpdatedEvent extends CommandWasRunEvent
{
	public function __construct(int $statusCode, string|null $message = null)
	{
		parent::__construct('twitter:user:update', $statusCode, $message);
	}
}
