<?php

namespace App\Factories;

use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Support\Facades\Validator;

class TweetValidatorFactory extends AbstractValidatorFactory
{
	/**
	 * Default validation rules for tweets
	 */
	protected static array $rules = [
		'id' => 'required|integer|numeric|digits:19',
		// TODO look into replacing with user array or similar instead
		'user_id' => 'integer|numeric|digits:10',
		'body' => 'required|string',
		'date' => 'required|date',
		'sub_tweet_id' => 'null|integer|numeric|digits:19',
		'entities' => 'required|json',
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
