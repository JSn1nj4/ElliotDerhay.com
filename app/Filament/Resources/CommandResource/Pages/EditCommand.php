<?php

namespace App\Filament\Resources\CommandResource\Pages;

use App\Filament\Resources\CommandResource;
use App\Filament\Resources\CommandResource\Traits\PreparesForValidation;
use App\Filament\Traits\HasEditActionsWithIcons;
use App\Filament\Traits\HasEditFormActionsWithIcons;
use Filament\Resources\Pages\EditRecord;

class EditCommand extends EditRecord
{
	use PreparesForValidation,
		HasEditActionsWithIcons,
		HasEditFormActionsWithIcons;

	protected static string $resource = CommandResource::class;
}
