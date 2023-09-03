<?php

namespace App\Filament\Resources\ImageResource\Pages;

use App\Filament\Resources\ImageResource;
use App\Filament\Traits\HasCreateActionWithIcon;
use Filament\Resources\Pages\ListRecords;

class ListImages extends ListRecords
{
	use HasCreateActionWithIcon;

    protected static string $resource = ImageResource::class;
}
