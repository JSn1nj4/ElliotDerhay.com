<?php

namespace App\Filament\Resources\ImageResource\Pages;

use App\Filament\Resources\ImageResource;
use App\Support\Sanitizer;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditImage extends EditRecord
{
    protected static string $resource = ImageResource::class;

    protected function getActions(): array
    {
        return [
			Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

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
