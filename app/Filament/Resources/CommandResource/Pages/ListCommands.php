<?php

namespace App\Filament\Resources\CommandResource\Pages;

use App\Filament\Resources\CommandResource;
use App\Filament\Traits\HasCreateActionWithIcon;
use Filament\Resources\Pages\ListRecords;

class ListCommands extends ListRecords
{
	use HasCreateActionWithIcon;

    protected static string $resource = CommandResource::class;
}
