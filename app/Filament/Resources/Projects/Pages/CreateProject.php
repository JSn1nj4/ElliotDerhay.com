<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use App\Filament\Resources\Projects\Traits\PreparesForValidation;
use App\Filament\Traits\HasCreateFormActionsWithIcons;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
	use PreparesForValidation,
		HasCreateFormActionsWithIcons;

	protected static string $resource = ProjectResource::class;
}
