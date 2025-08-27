<?php

namespace App\Filament\Resources\CommandEvents\Pages;

use App\Filament\Resources\CommandEvents\CommandEventResource;
use Filament\Resources\Pages\ListRecords;

class ListCommandEvents extends ListRecords
{
    protected static string $resource = CommandEventResource::class;
}
