<?php

namespace App\DataTransferObjects;

readonly class TelegramRecipient
{
	public function __construct(
		public string $telegram_chat_id,
	) {}

	public function __toString(): string
	{
		return $this->telegram_chat_id;
	}
}
