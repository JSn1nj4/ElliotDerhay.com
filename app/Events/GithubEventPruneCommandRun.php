<?php

namespace App\Events;

class GithubEventPruneCommandRun extends CommandWasRunEvent
{
    public function __construct()
    {
        parent::__construct('github:event:prune');
    }
}
