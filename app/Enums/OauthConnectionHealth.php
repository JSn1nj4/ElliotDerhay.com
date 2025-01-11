<?php

namespace App\Enums;

enum OauthConnectionHealth
{
	case Expired;
	case ExpiringSoon;
	case Good;
	case NotConfigured;

	public function label(): string
	{
		return match ($this) {
			self::ExpiringSoon => 'Expiring Soon',
			self::NotConfigured => 'Not Configured',
			default => $this->name,
		};
	}
}
