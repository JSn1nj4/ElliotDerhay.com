<?php

use App\Factories\TwitterUserValidatorFactory;
use Illuminate\Contracts\Validation\Validator;
use Tests\Support\TwitterUserDataFactory;

it('generates a Validator instance', function (): void {
	$validator = TwitterUserValidatorFactory::make(
		TwitterUserDataFactory::init()->makeOne()
	);

	expect($validator)->toBeInstanceOf(Validator::class);
});

it('builds the correct rule set', function (): void {
	$rulesets = new class {
		public array $empty = [];
		public array $extra = [
			'unknown_property' => 'null',
		];
		public array $overrides = [
			'id' => 'integer|numeric',
			'name' => 'text',
		];
	};

	$defaults = TwitterUserValidatorFactory::rules([]);

	$with_empty = TwitterUserValidatorFactory::rules($rulesets->empty);
	$with_extra = TwitterUserValidatorFactory::rules($rulesets->extra);
	$with_overrides = TwitterUserValidatorFactory::rules($rulesets->overrides);

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
		->toHaveKeys(['id', 'name']);
});

// builds the correct messages set

// builds the correct custom attributes set
