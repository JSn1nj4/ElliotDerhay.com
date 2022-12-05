<?php

namespace App\Events;

class GithubUsersUpdatedEvent extends CommandWasRunEvent
{
	public function __construct()
	{
		parent::__construct('github:user:update');
	}
}
