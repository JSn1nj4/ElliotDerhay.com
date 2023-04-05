<?php

namespace App\Events;

class GithubEventsPruned extends CommandWasRunEvent
{
    public function __construct(int $statusCode, string|null $message = null)
    {
        parent::__construct('github:event:prune', $statusCode, $message);
    }
}
