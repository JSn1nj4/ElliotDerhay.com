<?php

namespace App\Events;

class TweetsPruned extends CommandWasRunEvent
{
    public function __construct()
    {
        parent::__construct('tweet:prune');
    }
}
