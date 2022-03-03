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
