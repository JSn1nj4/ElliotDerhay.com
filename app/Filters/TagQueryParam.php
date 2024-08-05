<?php

namespace App\Filters;

class TagQueryParam
{
	public static function isIntegerLike(mixed $value): bool
	{
		return is_numeric($value)
			&& ((string)(int)$value) === (string)$value
			&& !(is_float($value));
	}

	public static function filter(mixed $value): int|null
	{
		if (!self::isIntegerLike($value)) return null;

		return (int)$value;
	}
}
