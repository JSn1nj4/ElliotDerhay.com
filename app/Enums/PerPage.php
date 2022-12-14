<?php

namespace App\Enums;

enum PerPage: int
{
	case MIN = 1;
	case MAX = 100;
	case DEFAULT = 10;

	public static function isIntegerLike(mixed $value): bool
	{
		return is_numeric($value) && ((string)intval($value)) === "$value";
	}

	public static function filter(mixed $value): int
	{
		if(!self::isIntegerLike($value)) return self::DEFAULT->value;

		$int = intval($value);

		return match(true) {
			$int < self::MIN->value => self::MIN->value,
			$int > self::MAX->value => self::MAX->value,
			default => $int,
		};
	}
}
