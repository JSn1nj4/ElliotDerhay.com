<?php

namespace App\Events;

class GithubToggleFeatureEvent extends CommandWasRunEvent
{
    public function __construct(int $exitCode, string $message)
	{
		parent::__construct('github:toggle_feature', $exitCode, $message);
	}
}
