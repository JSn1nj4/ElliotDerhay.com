<?php

namespace App\Events;

class GithubEventsPulledEvent extends CommandWasRunEvent
{
	public function __construct()
	{
		parent::__construct('github:event:pull');
	}
}
