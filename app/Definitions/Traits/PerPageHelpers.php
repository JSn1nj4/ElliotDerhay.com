<?php

namespace App\Definitions\Traits;

/**
 * For use with Per Page enums
 *
 * Requires MIN, MAX, and DEFAULT cases
 */
trait PerPageHelpers
{
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
