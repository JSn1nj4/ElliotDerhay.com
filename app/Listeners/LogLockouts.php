<?php

namespace App\Listeners;

use App\Models\Lockout;
use Illuminate\Auth\Events\Lockout as LockoutEvent;

class LogLockouts
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LockoutEvent  $event
     * @return void
     */
    public function handle(LockoutEvent $event)
    {
		Lockout::create([
			'ip_address' => $event->request->ip(),
			'url' => $event->request->getUri(),
			'user_agent' => $event->request->userAgent(),
			'content_type' => $event->request->getContentType(),
			'credential' => optional($event->request)->email,
		]);
    }
}
