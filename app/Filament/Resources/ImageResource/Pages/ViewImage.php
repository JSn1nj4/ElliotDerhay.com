<?php

namespace App\Filament\Resources\ImageResource\Pages;

use App\Filament\Resources\ImageResource;
use App\Filament\Traits\HasViewActionsWithIcons;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\IconPosition;

class ViewImage extends ViewRecord
{
	use HasViewActionsWithIcons;

    protected static string $resource = ImageResource::class;
}
