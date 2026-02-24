<?php

namespace App\Listeners;

use App\Events\PostPublishedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class SendPostPublishedNotification implements ShouldQueue
{
	use SerializesModels;

	public function handle(PostPublishedEvent $event): void {}
}
