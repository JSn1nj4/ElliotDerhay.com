<?php

namespace App\Filament\Resources\CommandResource\Pages;

use App\Filament\Resources\CommandResource;
use App\Filament\Traits\HasEditFormActionsWithIcons;
use App\Filament\Traits\HasEditActionsWithIcons;
use Filament\Resources\Pages\EditRecord;

class EditCommand extends EditRecord
{
	use CommandResource\Traits\PreparesForValidation,
		HasEditActionsWithIcons,
		HasEditFormActionsWithIcons;

    protected static string $resource = CommandResource::class;
}
