<?php

namespace App\Filament\Resources\Commands\Pages;

use App\Filament\Resources\Commands\CommandResource;
use App\Filament\Resources\Commands\Traits\PreparesForValidation;
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
