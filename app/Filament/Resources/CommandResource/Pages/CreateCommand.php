<?php

namespace App\Filament\Resources\CommandResource\Pages;

use App\Filament\Resources\CommandResource;
use Filament\Pages\Actions;
use Filament\Resources\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateCommand extends CreateRecord
{
    protected static string $resource = CommandResource::class;

	protected string|null $subheading = "Register a new admin panel command.";
}
