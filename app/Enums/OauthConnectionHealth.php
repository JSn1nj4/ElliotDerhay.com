<?php

namespace App\Enums;

enum OauthConnectionHealth
{
	case Good;
	case ExpiringSoon;
	case Expired;

	public function label(): string
	{
		return match ($this) {
			self::ExpiringSoon => 'Expiring Soon',
			default => $this->name,
		};
	}
}
