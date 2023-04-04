<?php

namespace App\Events;

class GithubUsersUpdatedEvent extends CommandWasRunEvent
{
	public function __construct(int $statusCode, string|null $message = null)
	{
		parent::__construct('github:user:update', $statusCode, $message);
	}
}
