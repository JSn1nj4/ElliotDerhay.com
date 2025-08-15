<?php

namespace App\Filament\Resources\Commands\Pages;

use App\Filament\Resources\Commands\CommandResource;
use App\Filament\Resources\Commands\Traits\PreparesForValidation;
use App\Filament\Traits\HasCreateFormActionsWithIcons;
use Filament\Resources\Pages\CreateRecord;

class CreateCommand extends CreateRecord
{
	use PreparesForValidation,
		HasCreateFormActionsWithIcons;

	protected static string $resource = CommandResource::class;

	protected string|null $subheading = "Register a new admin panel command.";
}
