<?php

namespace App\Events;

class TwitterToggleFeatureEvent extends CommandWasRunEvent
{
    /**
     * Create a new event instance.
     */
	public function __construct(int $statusCode, string|null $message = null)
	{
		parent::__construct('twitter:toggle_feature', $statusCode, $message);
	}
}
