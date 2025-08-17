<?php

namespace App\Filters;

class SearchParam
{
	public static function filter(string|null $search): string|null
	{
		return match (true) {
			is_string($search) => str($search)
				->replaceMatches('/[^a-zA-Z0-9_]/', ' ')
				->trim(),
			default => null,
		};
	}
}
