<?php

namespace App\Enums;

use BackedEnum;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;

enum PostStatus: string implements HasColor, HasIcon, HasLabel
{
	case Draft = 'draft';
	case Scheduled = 'scheduled';
	case Published = 'published';

	public function getLabel(): string|Htmlable|null
	{
		return $this->name;
	}

	public function getColor(): string|array|null
	{
		return match ($this) {
			self::Draft => 'gray',
			self::Scheduled => 'warning',
			self::Published => 'success',
		};
	}

	public function getIcon(): string|BackedEnum|Htmlable|null
	{
		return match ($this) {
			self::Draft => Heroicon::OutlinedPencilSquare,
			self::Scheduled => Heroicon::OutlinedClock,
			self::Published => Heroicon::OutlinedCheckBadge,
		};
	}
}
