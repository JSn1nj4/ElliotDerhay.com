<?php

namespace App\Filament\Resources\CommandResource\Traits;

use App\Support\Sanitizer;

trait PreparesForValidation
{
	protected function prepareForValidation($attributes): array
	{
		$attributes['date'] = collect($attributes['data'])
			->transform(static function ($item, $key) {
				if ($item === null) return null;

				return match ($key) {
					'signature', 'description' => Sanitizer::sanitize($item)->toString(),
					default => $item,
				};
			});

		return $attributes;
	}
}
