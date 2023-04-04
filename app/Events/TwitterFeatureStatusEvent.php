<?php

namespace App\Events;

class TwitterFeatureStatusEvent extends CommandWasRunEvent
{
    /**
     * Create a new event instance.
     */
	public function __construct(int $statusCode, string|null $message = null)
	{
		parent::__construct('twitter:feature_status', $statusCode, $message);
	}
}
