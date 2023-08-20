<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Support\Sanitizer;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

	protected function prepareForValidation($attributes)
	{
		$attributes['name'] = Sanitizer::sanitize($attributes['name']);

		$attributes['short_desc'] = Sanitizer::sanitize($attributes['short_desc']);

		$attributes['link'] = Sanitizer::url($attributes['link']);

		if (isset($attributes['demo_link'])) {
			$attributes['demo_link'] = Sanitizer::url($attributes['demo_link']);
		}

		return $attributes;
	}
}
