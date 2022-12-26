<?php

namespace App\Events;

class TokensPrunedEvent extends CommandWasRunEvent
{
    public function __construct()
    {
        parent::__construct('token:prune');
    }
}
