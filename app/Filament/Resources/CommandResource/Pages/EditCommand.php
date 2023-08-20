<?php

namespace App\Filament\Resources\CommandResource\Pages;

use App\Filament\Resources\CommandResource;
use App\Support\Sanitizer;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCommand extends EditRecord
{
    protected static string $resource = CommandResource::class;

	protected function prepareForValidation($attributes)
	{
		$attributes['signature'] = Sanitizer::sanitize($attributes['signature']);

		$attributes['description'] = Sanitizer::sanitize($attributes['description']);

		return $attributes;
	}

	protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
