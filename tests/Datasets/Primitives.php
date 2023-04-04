<?php

use function Pest\Faker\fake;

dataset('integers', [
	fake()->randomNumber(),
	fake()->randomNumber(),
	fake()->randomNumber(),
	fake()->randomNumber(),
	fake()->randomNumber(),
]);

dataset('integer_strings', [
	(string) fake()->randomNumber(),
	(string) fake()->randomNumber(),
	(string) fake()->randomNumber(),
	(string) fake()->randomNumber(),
	(string) fake()->randomNumber(),
]);

dataset('int_between_1_and_100', [
	fake()->numberBetween(1, 100),
	fake()->numberBetween(1, 100),
	fake()->numberBetween(1, 100),
	fake()->numberBetween(1, 100),
	fake()->numberBetween(1, 100),
]);

dataset('int_string_between_1_and_100', [
	(string) fake()->numberBetween(1, 100),
	(string) fake()->numberBetween(1, 100),
	(string) fake()->numberBetween(1, 100),
	(string) fake()->numberBetween(1, 100),
	(string) fake()->numberBetween(1, 100),
]);

dataset('ints_above_100', [
	fake()->numberBetween(101),
	fake()->numberBetween(101),
	fake()->numberBetween(101),
	fake()->numberBetween(101),
	fake()->numberBetween(101),
]);

dataset('ints_below_1', function () {
	yield 0 - fake()->numberBetween();
	yield 0 - fake()->numberBetween();
	yield 0 - fake()->numberBetween();
	yield 0 - fake()->numberBetween();
	yield 0 - fake()->numberBetween();
});

dataset('random_non_ints', function () {
	yield fake()->randomFloat();
	yield fake()->randomFloat();
	yield fake()->name();
	yield fake()->name();
	yield fake()->password();
	yield fake()->password();
	yield fake()->boolean();
	yield fake()->boolean();
	yield null;
});
