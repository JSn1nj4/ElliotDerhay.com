<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Filament\Traits\HasCreateFormActionsWithIcons;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
	use ProjectResource\Traits\PreparesForValidation,
		HasCreateFormActionsWithIcons;

    protected static string $resource = ProjectResource::class;
}
