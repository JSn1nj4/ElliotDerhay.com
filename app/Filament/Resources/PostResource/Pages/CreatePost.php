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
		$attributes['data'] = collect($attributes['data'])
			->transform(static fn ($item, $key) => match($key) {
				'title' => Sanitizer::sanitize($item)->toString(),
				'slug' => Sanitizer::slug($item)->toString(),
				default => $item,
			});

		return $attributes;
	}
}
