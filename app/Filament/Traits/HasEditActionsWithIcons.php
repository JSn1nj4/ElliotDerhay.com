<?php

namespace App\Filament\Traits;

use Filament\Support\Enums\IconPosition;

trait HasEditActionsWithIcons
{
	protected function getActions(): array
	{
		return [
			\Filament\Actions\ViewAction::make()
				->icon('o-magnifying-glass')
				->iconPosition(IconPosition::After),
			\Filament\Actions\DeleteAction::make()
				->icon('o-trash')
				->iconPosition(IconPosition::After),
		];
	}
}
