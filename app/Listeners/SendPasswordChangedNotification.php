<?php

namespace App\Listeners;

use App\Mail\PasswordChangedEmail;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPasswordChangedNotification
{
	private array $recipients = [];

    public function __construct()
    {
        $this->recipients[] = [
			'name' => config('mail.to.name'),
			'email' => config('mail.to.address'),
		];
    }

    public function handle(PasswordReset $event): void
    {
        Mail::to($this->recipients)
			->send(new PasswordChangedEmail());
    }
}
