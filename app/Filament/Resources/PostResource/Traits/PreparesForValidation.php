<?php

namespace App\Filament\Resources\PostResource\Traits;

use App\Support\Sanitizer;

trait PreparesForValidation
{
	protected function prepareForValidation($attributes)
	{
		$attributes['data'] = collect($attributes['data'])
			->transform(static function ($item, $key) {
				if ($item === null) return null;

				return match($key) {
					'title' => Sanitizer::sanitize($item)->toString(),
					'slug' => Sanitizer::slug($item)->toString(),
					default => $item,
				};
			});

		return $attributes;
	}
}
