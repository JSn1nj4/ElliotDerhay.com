<?php

namespace App\Filament\Resources\Images\Pages;

use App\Filament\Resources\Images\ImageResource;
use App\Filament\Traits\HasViewActionsWithIcons;
use Filament\Resources\Pages\ViewRecord;

class ViewImage extends ViewRecord
{
	use HasViewActionsWithIcons;

    protected static string $resource = ImageResource::class;
}
