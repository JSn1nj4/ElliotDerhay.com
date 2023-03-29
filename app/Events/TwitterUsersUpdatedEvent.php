<?php

namespace App\Events;

class TwitterUsersUpdatedEvent extends CommandWasRunEvent
{
	public function __construct()
	{
		parent::__construct('twitter:user:update');
	}
}
