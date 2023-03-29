<?php

namespace App\Events;

class TweetsPulledEvent extends CommandWasRunEvent
{
	public function __construct()
	{
		parent::__construct('tweet:pull');
	}
}
