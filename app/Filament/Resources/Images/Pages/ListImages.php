<?php

namespace App\Filament\Resources\Images\Pages;

use App\Filament\Resources\Images\ImageResource;
use App\Filament\Traits\HasCreateActionWithIcon;
use Filament\Resources\Pages\ListRecords;

class ListImages extends ListRecords
{
	use HasCreateActionWithIcon;

    protected static string $resource = ImageResource::class;
}
