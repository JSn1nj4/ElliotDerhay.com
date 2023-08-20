<?php

namespace App\Support;

use Illuminate\Support\Stringable;

class Sanitizer
{
	// If ever filtering ':' in the future, split off a separate
	// 'command' method that allows ':'.
	public static function sanitize(string $input): Stringable
	{
		return str($input)
			->stripTags()
			->remove([
				"{", "}", "[", "]", '<', '>',
				"`", "~", "!", "@", "#", '$',
				'%', '^', '*', '+', '=', '/',
				'\\', "\r", "\n"
			])
			->trim();
	}

	public static function slug(string $input): Stringable
	{
		return str($input)->stripTags()->slug();
	}

	public static function url(string $input): Stringable
	{
		return str($input)->stripTags()->trim();
	}
}
