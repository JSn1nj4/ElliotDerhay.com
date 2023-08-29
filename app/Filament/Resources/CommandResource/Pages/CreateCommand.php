<?php

namespace App\Filament\Resources\CommandResource\Pages;

use App\Filament\Resources\CommandResource;
use App\Filament\Traits\HasCreateFormActionsWithIcons;
use Filament\Resources\Pages\CreateRecord;

class CreateCommand extends CreateRecord
{
	use CommandResource\Traits\PreparesForValidation,
		HasCreateFormActionsWithIcons;

    protected static string $resource = CommandResource::class;

	protected string|null $subheading = "Register a new admin panel command.";
}
