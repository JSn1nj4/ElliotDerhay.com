<?php

namespace App\Support;

use Illuminate\Support\Stringable;

class Sanitizer
{
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
}
