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
		return ((string)intval($value)) === "$value";
	}

	public static function filter(mixed $value): int
	{
		$int = intval($value);

		return match(true) {
			$int < self::MIN->value => self::MIN->value,
			$int > self::MAX->value => self::MAX->value,
			self::isIntegerLike($value) => $int,
			default => self::DEFAULT->value,
		};
	}
}
