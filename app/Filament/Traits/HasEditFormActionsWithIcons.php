<?php

namespace App\Filament\Traits;

use Filament\Support\Enums\IconPosition;

trait HasEditFormActionsWithIcons
{
	protected function getFormActions(): array
	{
		[$save, $cancel] = parent::getFormActions();

		return [
			$save
				->icon('o-circle-stack')
				->iconPosition(IconPosition::After),
			$cancel
				->icon('o-arrow-uturn-left')
				->iconPosition(IconPosition::After),
		];
	}
}
