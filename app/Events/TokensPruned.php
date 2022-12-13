<?php

namespace App\Events;

class TokensPruned extends CommandWasRunEvent
{
    public function __construct()
    {
        parent::__construct('token:prune');
    }
}
