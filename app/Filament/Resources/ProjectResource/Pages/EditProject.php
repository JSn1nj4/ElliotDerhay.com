<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Filament\Resources\ProjectResource\Traits\PreparesForValidation;
use App\Filament\Traits\HasEditFormActionsWithIcons;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\IconPosition;

class EditProject extends EditRecord
{
	use PreparesForValidation,
		HasEditFormActionsWithIcons;

	protected static string $resource = ProjectResource::class;

	protected function getActions(): array
	{
		return [
			DeleteAction::make()
				->icon('o-trash')
				->iconPosition(IconPosition::After),
		];
	}
}
