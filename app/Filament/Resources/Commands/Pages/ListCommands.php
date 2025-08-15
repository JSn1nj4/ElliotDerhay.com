<?php

namespace App\Filament\Resources\Commands\Pages;

use App\Filament\Resources\Commands\CommandResource;
use App\Filament\Traits\HasCreateActionWithIcon;
use Filament\Resources\Pages\ListRecords;

class ListCommands extends ListRecords
{
	use HasCreateActionWithIcon;

    protected static string $resource = CommandResource::class;
}
