<?php

namespace App\Enums;

enum PerPage: int
{
	case Min = 1;
	case Max = 100;
	case Default = 10;

	public static function isIntegerLike(mixed $value): bool
	{
		return is_numeric($value)
			&& ((string)intval($value)) === "$value"
			&& !(is_float($value));
	}

	public static function filter(mixed $value): int
	{
		if(!self::isIntegerLike($value)) return self::Default->value;

		$int = intval($value);

		return match(true) {
			$int < self::Min->value => self::Min->value,
			$int > self::Max->value => self::Max->value,
			default => $int,
		};
	}
}
