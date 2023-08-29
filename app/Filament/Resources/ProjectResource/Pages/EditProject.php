<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Filament\Traits\HasEditFormActionsWithIcons;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\IconPosition;

class EditProject extends EditRecord
{
	use ProjectResource\Traits\PreparesForValidation,
		HasEditFormActionsWithIcons;

    protected static string $resource = ProjectResource::class;

    protected function getActions(): array
    {
        return [
			Actions\DeleteAction::make()
				->icon('o-trash')
				->iconPosition(IconPosition::After),
        ];
    }
}
