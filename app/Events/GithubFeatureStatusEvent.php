<?php

namespace App\Events;

class GithubFeatureStatusEvent extends CommandWasRunEvent
{
    public function __construct(int $exitCode, string $message)
    {
        parent::__construct('github:feature_status', $exitCode, $message);
    }
}
