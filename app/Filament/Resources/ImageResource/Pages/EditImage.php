<?php

namespace App\Filament\Resources\ImageResource\Pages;

use App\Filament\Resources\ImageResource;
use App\Filament\Traits\HasEditFormActionsWithIcons;
use App\Filament\Traits\HasEditActionsWithIcons;
use App\Support\Sanitizer;
use Filament\Resources\Pages\EditRecord;

class EditImage extends EditRecord
{
	use HasEditActionsWithIcons,
		HasEditFormActionsWithIcons;

    protected static string $resource = ImageResource::class;

	protected function prepareForValidation($attributes)
	{
		$attributes['data']['name'] = Sanitizer::sanitize($attributes['data']['name']);

		return $attributes;
	}
}
