<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use App\Filament\Resources\Projects\Traits\PreparesForValidation;
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
