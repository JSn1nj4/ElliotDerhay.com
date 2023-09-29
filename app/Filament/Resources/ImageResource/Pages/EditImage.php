<?php

namespace App\Filament\Resources\ImageResource\Pages;

use App\Filament\Resources\ImageResource;
use App\Filament\Traits\HasEditActionsWithIcons;
use App\Filament\Traits\HasEditFormActionsWithIcons;
use App\Support\Sanitizer;
use Filament\Resources\Pages\EditRecord;

class EditImage extends EditRecord
{
	use HasEditActionsWithIcons,
		HasEditFormActionsWithIcons;

	protected static string $resource = ImageResource::class;

	protected function prepareForValidation($attributes)
	{
		$attributes['data'] = collect($attributes['data'])
			->transform(static function ($item, $key) {
				if ($item === null) return null;

				return match ($key) {
					'name' => Sanitizer::sanitize($item)->toString(),
					'caption' => Sanitizer::paragraph($item)->toString(),
					default => $item,
				};
			});

		return $attributes;
	}
}
