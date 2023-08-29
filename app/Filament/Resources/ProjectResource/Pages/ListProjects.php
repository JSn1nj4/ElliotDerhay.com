<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Filament\Traits\HasNewActionWithIcon;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProjects extends ListRecords
{
	use HasNewActionWithIcon;

    protected static string $resource = ProjectResource::class;
}
