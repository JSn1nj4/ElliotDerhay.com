<?php

namespace App\Filament\Resources\CommandResource\Pages;

use App\Filament\Resources\CommandResource;
use App\Filament\Resources\CommandResource\Traits\PreparesForValidation;
use App\Filament\Traits\HasCreateFormActionsWithIcons;
use Filament\Resources\Pages\CreateRecord;

class CreateCommand extends CreateRecord
{
	use PreparesForValidation,
		HasCreateFormActionsWithIcons;

	protected static string $resource = CommandResource::class;

	protected string|null $subheading = "Register a new admin panel command.";
}
