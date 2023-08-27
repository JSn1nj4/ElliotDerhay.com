<?php

namespace App\Filament\Resources\ProjectResource\Traits;

use App\Support\Sanitizer;

trait PreparesForValidation
{
	protected function prepareForValidation($attributes)
	{
		$attributes['data'] = collect($attributes['data'])
			->transform(static function ($item, $key) {
				if ($item === null) return null;

				return match ($key) {
					'name', 'short_desc' => Sanitizer::sanitize($item)->toString(),
					'link', 'demo_link' => Sanitizer::url($item)->toString(),
					default => $item,
				};
			});

		return $attributes;
	}
}
