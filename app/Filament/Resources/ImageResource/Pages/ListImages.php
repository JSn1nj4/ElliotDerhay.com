<?php

namespace App\Filament\Resources\ImageResource\Pages;

use App\Filament\Resources\ImageResource;
use App\Filament\Traits\HasNewActionWithIcon;
use Filament\Resources\Pages\ListRecords;

class ListImages extends ListRecords
{
	use HasNewActionWithIcon;

    protected static string $resource = ImageResource::class;
}
