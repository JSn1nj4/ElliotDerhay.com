<?php

namespace App\Filament\Traits;

trait HasCountBadge
{
	public static function getNavigationBadge(): string|null
	{
		return static::getModel()::count();
	}
}
