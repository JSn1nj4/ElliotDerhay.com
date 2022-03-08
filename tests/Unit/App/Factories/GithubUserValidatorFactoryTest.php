<?php

use App\Factories\GithubUserValidatorFactory;

it('generates a Validator instance', function (): void {
	$validator = GithubUserValidatorFactory::make(
		\Tests\Support\GithubUserDataFactory::init()->makeOne()
	);

	expect($validator)->toBeInstanceOf(\Illuminate\Contracts\Validation\Validator::class);
});

it('builds the correct rule set', function (): void {
	$rulesets = new class {
		public array $empty = [];
		public array $extra = [
			'unknown_property' => 'null',
		];
		public array $overrides = [
			'id' => 'integer|numeric',
			'login' => 'string',
		];
	};

	$defaults = GithubUserValidatorFactory::rules([]);

	$with_empty = GithubUserValidatorFactory::rules($rulesets->empty);
	$with_extra = GithubUserValidatorFactory::rules($rulesets->extra);
	$with_overrides = GithubUserValidatorFactory::rules($rulesets->overrides);

	expect(array_diff_assoc($with_empty, $defaults))
		->toBeArray()
		->toHaveCount(0)
		->and(array_diff_assoc($with_extra, $defaults))
		->toBeArray()
		->toHaveCount(1)
		->toHaveKey('unknown_property', 'null')
		->and(array_diff_assoc($with_overrides, $defaults))
		->toBeArray()
		->toHaveCount(2)
		->toHaveKeys(['id', 'login']);
});

/**
 * @todo: add overrides if custom messages are added to the factory
 * classes in the future
 */
it('builds the correct messages set', function (): void {
	$message_sets = new class {
		public array $empty = [];
		public array $extra = [
			'required' => 'The field called :attribute is a required field.',
		];
//		public array $overrides = [
//			'' => '',
//			'' => '',
//		];
	};

	$defaults = GithubUserValidatorFactory::messages([]);

	$with_empty = GithubUserValidatorFactory::messages($message_sets->empty);
	$with_extra = GithubUserValidatorFactory::messages($message_sets->extra);
//	$with_overrides = TwitterUserValidatorFactory::messages($message_sets->overrides);

	expect(array_diff_assoc($with_empty, $defaults))
		->toBeArray()
		->toHaveCount(0)
		->and(array_diff_assoc($with_extra, $defaults))
		->toBeArray()
		->toHaveCount(1)
		->toHaveKey('required', 'The field called :attribute is a required field.');
//		->toHaveKey('unknown_property', 'null')
//		->and(array_diff_assoc($with_overrides, $defaults))
//		->toBeArray()
//		->toHaveCount(2)
//		->toHaveKeys(['id', 'name']);
});

/**
 * @todo: add overrides if custom attributes are added to the factory
 * classes in the future
 */
it('builds the correct custom attributes set', function (): void {
	$attribute_sets = new class {
		public array $empty = [];
		public array $extra = [
			'display_login' => 'display login',
		];
//		public array $overrides = [
//			'' => '',
//			'' => '',
//		];
	};

	$defaults = GithubUserValidatorFactory::messages([]);

	$with_empty = GithubUserValidatorFactory::messages($attribute_sets->empty);
	$with_extra = GithubUserValidatorFactory::messages($attribute_sets->extra);
//	$with_overrides = TwitterUserValidatorFactory::messages($message_sets->overrides);

	expect(array_diff_assoc($with_empty, $defaults))
		->toBeArray()
		->toHaveCount(0)
		->and(array_diff_assoc($with_extra, $defaults))
		->toBeArray()
		->toHaveCount(1)
		->toHaveKey('display_login', 'display login');
//		->toHaveKey('unknown_property', 'null')
//		->and(array_diff_assoc($with_overrides, $defaults))
//		->toBeArray()
//		->toHaveCount(2)
//		->toHaveKeys(['id', 'name']);
});
