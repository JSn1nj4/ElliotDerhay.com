<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Support\Sanitizer;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

	protected function prepareForValidation($attributes)
	{
		$attributes['title'] = Sanitizer::sanitize($attributes['title']);

		$attributes['slug'] = Sanitizer::slug($attributes['slug']);

		// $attributes['body'] = Sanitizer::url($attributes['body']);

		return $attributes;
	}
}
