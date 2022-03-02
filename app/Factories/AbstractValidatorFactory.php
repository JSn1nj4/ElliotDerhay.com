<?php

namespace App\Factories;

use Illuminate\Contracts\Validation\Validator;

abstract class AbstractValidatorFactory
{
	/**
	 * Default custom attributes shared between validator factories
	 */
	protected static array $customAttributes = [];

	/**
	 * Default messages shared between validator factories
	 */
	protected static array $messages = [];

	/**
	 * Default rules shared between validator factories
	 */
	protected static array $rules = [];

	/**
	 * Return default custom attributes with any overrides
	 */
	static function customAttributes(array $customAttributes): array
	{
		return array_merge(static::$customAttributes, $customAttributes);
	}

	/**
	 * Method required to be defined by all inheriting factories
	 */
	abstract static function make(array $input, array $rules, array $messages): Validator;

	/**
	 * Return default messages with any overrides
	 */
	static function messages(array $messages): array
	{
		return array_merge(static::$messages, $messages);
	}

	/**
	 * Return default rules with any overrides
	 */
	static function rules(array $rules): array
	{
		return array_merge(static::$rules, $rules);
	}
}
