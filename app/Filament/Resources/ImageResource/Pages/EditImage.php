<?php

namespace App\Filament\Resources\ImageResource\Pages;

use App\Filament\Resources\ImageResource;
use App\Filament\Traits\HasEditFormActionsWithIcons;
use App\Filament\Traits\HasEditActionsWithIcons;
use App\Support\Sanitizer;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Enums\IconPosition;
use function Livewire\after;

class EditImage extends EditRecord
{
	use HasEditActionsWithIcons,
		HasEditFormActionsWithIcons;

    protected static string $resource = ImageResource::class;

	protected function prepareForValidation($attributes)
	{
		// $attributes['data'] = collect($attributes['data'])
		// 	->transform(static fn ($item, $key) => match($key) {
		// 		'name' => Sanitizer::sanitize($item)->toString(),
		// 		default => $item,
		// 	});

		$attributes['data']['name'] = Sanitizer::sanitize($attributes['data']['name']);

		return $attributes;
	}
}
