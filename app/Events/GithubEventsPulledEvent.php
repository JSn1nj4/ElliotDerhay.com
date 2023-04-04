<?php

namespace App\Events;

class GithubEventsPulledEvent extends CommandWasRunEvent
{
	public function __construct(int $statusCode, string|null $message = null)
	{
		parent::__construct('github:event:pull', $statusCode, $message);
	}
}
