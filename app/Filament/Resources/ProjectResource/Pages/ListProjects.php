<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Filament\Traits\HasCreateActionWithIcon;
use Filament\Resources\Pages\ListRecords;

class ListProjects extends ListRecords
{
	use HasCreateActionWithIcon;

    protected static string $resource = ProjectResource::class;
}
