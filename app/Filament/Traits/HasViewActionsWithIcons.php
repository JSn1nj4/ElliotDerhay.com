<?php

namespace App\Filament\Traits;

use Filament\Support\Enums\IconPosition;

trait HasViewActionsWithIcons
{
	protected function getActions(): array
	{
		return [
			\Filament\Actions\EditAction::make()
				->icon('o-pencil-square')
				->iconPosition(IconPosition::After),
			\Filament\Actions\DeleteAction::make()
				->icon('o-trash')
				->iconPosition(IconPosition::After),
		];
	}
}
