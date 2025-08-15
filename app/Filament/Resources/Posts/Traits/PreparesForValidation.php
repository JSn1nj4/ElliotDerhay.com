<?php

namespace App\Filament\Resources\Posts\Traits;

use App\Support\Sanitizer;

trait PreparesForValidation
{
	protected function prepareForValidation($attributes): array
	{
		$attributes['data'] = collect($attributes['data'])
			->transform(static function ($item, $key) {
				if ($item === null) return null;

				return match ($key) {
					'title' => Sanitizer::sanitize($item)->toString(),
					'slug' => Sanitizer::slug($item)->toString(),
					default => $item,
				};
			});

		return $attributes;
	}
}
