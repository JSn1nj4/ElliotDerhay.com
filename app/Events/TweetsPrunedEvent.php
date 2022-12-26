<?php

namespace App\Events;

class TweetsPrunedEvent extends CommandWasRunEvent
{
    public function __construct()
    {
        parent::__construct('tweet:prune');
    }
}
