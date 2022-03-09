<?php

use App\Factories\TweetValidatorFactory;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Tests\Support\TweetDataFactory;

it('generates a Validator instance', function (): void {
	$validator = TweetValidatorFactory::make(
		TweetDataFactory::init()->makeOne()
	);

	expect($validator)->toBeInstanceOf(ValidatorContract::class);
});

it('builds the correct rule set', function (): void {
	$rulesets = new class {
		public array $empty = [];
		public array $extra = [
			'unknown_property' => 'null',
		];
		public array $overrides = [
			'id' => 'integer|numeric',
			'body' => 'string',
		];
	};

	$defaults = TweetValidatorFactory::rules([]);

	$with_empty = TweetValidatorFactory::rules($rulesets->empty);
	$with_extra = TweetValidatorFactory::rules($rulesets->extra);
	$with_overrides = TweetValidatorFactory::rules($rulesets->overrides);

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
		->toHaveKeys(['id', 'body']);
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

	$defaults = TweetValidatorFactory::messages([]);

	$with_empty = TweetValidatorFactory::messages($message_sets->empty);
	$with_extra = TweetValidatorFactory::messages($message_sets->extra);
//	$with_overrides = TweetValidatorFactory::messages($message_sets->overrides);

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
			'body' => 'tweet content',
		];
//		public array $overrides = [
//			'' => '',
//			'' => '',
//		];
	};

	$defaults = TweetValidatorFactory::messages([]);

	$with_empty = TweetValidatorFactory::messages($attribute_sets->empty);
	$with_extra = TweetValidatorFactory::messages($attribute_sets->extra);
//	$with_overrides = TweetValidatorFactory::messages($message_sets->overrides);

	expect(array_diff_assoc($with_empty, $defaults))
		->toBeArray()
		->toHaveCount(0)
		->and(array_diff_assoc($with_extra, $defaults))
		->toBeArray()
		->toHaveCount(1)
		->toHaveKey('body', 'tweet content');
//		->toHaveKey('unknown_property', 'null')
//		->and(array_diff_assoc($with_overrides, $defaults))
//		->toBeArray()
//		->toHaveCount(2)
//		->toHaveKeys(['id', 'name']);
});
