<?php

namespace App\DataTransferObjects;

readonly class TelegramRecipient
{
	public function __construct(
		public string $recipient,
	) {}

	public function __toString(): string
	{
		return $this->recipient;
	}
}
