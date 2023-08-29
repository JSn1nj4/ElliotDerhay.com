<?php

namespace App\Filament\Resources\CommandResource\Pages;

use App\Filament\Resources\CommandResource;
use App\Filament\Traits\HasNewActionWithIcon;
use Filament\Resources\Pages\ListRecords;

class ListCommands extends ListRecords
{
	use HasNewActionWithIcon;

    protected static string $resource = CommandResource::class;
}
