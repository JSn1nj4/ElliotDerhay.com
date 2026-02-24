<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class PostPublishedNotification extends Notification implements ShouldQueue
{
	use Queueable;

	public function __construct(protected Post $post) {}

	public function via(object $notifiable): array
	{
		return ['telegram'];
	}

	public function toTelegram(object $notifiable): TelegramMessage
	{
		return TelegramMessage::create()
			->to($notifiable->telegram_chat_id)
			->content($this->post->title)
			->line("Your post has been published!")
			->button('View Post', route('blog.show', ['post' => $this->post]));
	}
}
