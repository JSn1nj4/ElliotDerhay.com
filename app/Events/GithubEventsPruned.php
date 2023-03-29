<?php

namespace App\Events;

class GithubEventsPruned extends CommandWasRunEvent
{
    public function __construct()
    {
        parent::__construct('github:event:prune');
    }
}
