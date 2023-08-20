<?php

namespace App\Filament\Resources\CommandResource\Pages;

use App\Filament\Resources\CommandResource;
use App\Support\Sanitizer;
use Filament\Resources\Pages\CreateRecord;

class CreateCommand extends CreateRecord
{
    protected static string $resource = CommandResource::class;

	protected string|null $subheading = "Register a new admin panel command.";

	protected function prepareForValidation($attributes)
	{
		$attributes['signature'] = Sanitizer::sanitize($attributes['signature']);

		$attributes['description'] = Sanitizer::sanitize($attributes['description']);

		return $attributes;
	}
}
