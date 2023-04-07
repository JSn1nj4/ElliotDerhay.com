<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdminLoginFeatureToggleEvent extends CommandWasRunEvent
{
	/**
	 * Create a new event instance.
	 */
	public function __construct(int $statusCode, string|null $message = null)
	{
		parent::__construct('admin:login_toggle', $statusCode, $message);
	}
}
