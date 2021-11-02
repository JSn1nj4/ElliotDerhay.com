<?php

namespace App\Listeners;

use App\Events\NewGithubEventTypesEvent;
use App\Mail\GithubEventEmail;
use Illuminate\Support\Facades\Mail;

class SendNewGithubEventTypesEmail
{
	public function __construct()
	{
		//
	}

	public function handle(NewGithubEventTypesEvent $event): void
	{
		Mail::to($event->emailRecipients)
			->send(new GithubEventEmail(
				$event->newEventTypes
					->unique()
					->values()
					->toArray()
			));
	}
}
