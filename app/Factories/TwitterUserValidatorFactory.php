<?php

namespace App\Factories;

use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Support\Facades\Validator;

class TwitterUserValidatorFactory extends AbstractValidatorFactory
{
	/**
	 * Default validation rules for Twitter users
	 */
	protected static array $rules = [
		'id' => 'required|integer|numeric|digits:10',
		'name' => 'required|string',
		'screen_name' => 'required|string',
		'profile_image_url_https' => 'required|url',
	];

	/**
	 * Generate a validator object using Validator facade
	 */
	public static function make(array $input, array $rules = [], array $messages = [], array $customAttributes = []): ValidatorContract
	{
		return Validator::make(
			$input,
			self::rules($rules),
			self::messages($messages),
			self::customAttributes($customAttributes)
		);
	}
}
