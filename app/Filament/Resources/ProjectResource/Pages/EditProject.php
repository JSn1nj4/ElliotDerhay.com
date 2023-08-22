<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Support\Sanitizer;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

	protected function prepareForValidation($attributes)
	{
		$attributes['data'] = collect($attributes['data'])
			->transform(static fn ($item, $key) => match($key) {
				'name', 'short_desc' => Sanitizer::sanitize($item)->toString(),
				'link', 'demo_link' => Sanitizer::url($item)->toString(),
				default => $item,
			});

		return $attributes;
	}
}
