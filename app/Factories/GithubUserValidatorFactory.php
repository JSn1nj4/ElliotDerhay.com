<?php

namespace App\Factories;

use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Support\Facades\Validator;

class GithubUserValidatorFactory extends AbstractValidatorFactory
{
	protected static array $rules = [
		'id' => 'required|integer|numeric|digits:7',
		'login' => 'required|string',
		'display_login' => 'required|string',
		'avatar_url' => 'required|url',
	];

	public static function make(array $input, array $rules = [], array $messages = [], array $customAttributes = []): ValidatorContract
	{
		return Validator::make(
			$input,
			self::rules($rules),
			self::messages($messages),
			self::customAttributes($customAttributes),
		);
	}
}
