<?php

namespace App\Filament\Traits;

use Filament\Support\Enums\IconPosition;

trait HasCreateActionWithIcon
{
	protected function getActions(): array
	{
		return [
			\Filament\Actions\CreateAction::make()
				->icon('o-document-plus')
				->iconPosition(IconPosition::After),
		];
	}
}
