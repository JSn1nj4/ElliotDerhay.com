<?php

namespace App\Listeners;

use App\DataTransferObjects\TelegramRecipient;
use App\Events\PostPublishedEvent;
use App\Notifications\PostPublishedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendPostPublishedNotification implements ShouldQueue
{
	use SerializesModels;

	public function handle(PostPublishedEvent $event): void
	{
		$recipient = resolve(TelegramRecipient::class);

		Notification::route('telegram', $recipient)
			->notify(new PostPublishedNotification($event->post));
	}
}
