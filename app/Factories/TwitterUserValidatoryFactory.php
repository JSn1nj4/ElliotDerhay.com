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
		'id' => '',
		'name' => '',
		'screen_name' => '',
		'profile_image_url_https' => '',
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
