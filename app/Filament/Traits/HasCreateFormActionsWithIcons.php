<?php

namespace App\Filament\Traits;

use Filament\Support\Enums\IconPosition;

trait HasCreateFormActionsWithIcons
{
	protected function getFormActions(): array
	{
		[$create, $createAnother, $cancel] = parent::getFormActions();

		return [
			$create
				->icon('o-circle-stack')
				->iconPosition(IconPosition::After),
			$createAnother
				->icon('o-document-plus')
				->iconPosition(IconPosition::After),
			$cancel
				->icon('o-arrow-uturn-left')
				->iconPosition(IconPosition::After),
		];
	}
}
