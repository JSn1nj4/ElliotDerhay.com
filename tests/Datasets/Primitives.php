<?php

use function Pest\Faker\faker;

dataset('integers', [
	faker()->randomNumber(),
	faker()->randomNumber(),
	faker()->randomNumber(),
	faker()->randomNumber(),
	faker()->randomNumber(),
]);

dataset('integer_strings', [
	(string) faker()->randomNumber(),
	(string) faker()->randomNumber(),
	(string) faker()->randomNumber(),
	(string) faker()->randomNumber(),
	(string) faker()->randomNumber(),
]);

dataset('int_between_1_and_100', [
	faker()->numberBetween(1, 100),
	faker()->numberBetween(1, 100),
	faker()->numberBetween(1, 100),
	faker()->numberBetween(1, 100),
	faker()->numberBetween(1, 100),
]);

dataset('int_string_between_1_and_100', [
	(string) faker()->numberBetween(1, 100),
	(string) faker()->numberBetween(1, 100),
	(string) faker()->numberBetween(1, 100),
	(string) faker()->numberBetween(1, 100),
	(string) faker()->numberBetween(1, 100),
]);

dataset('ints_above_100', [
	faker()->numberBetween(101),
	faker()->numberBetween(101),
	faker()->numberBetween(101),
	faker()->numberBetween(101),
	faker()->numberBetween(101),
]);

dataset('ints_below_1', function () {
	yield 0 - faker()->numberBetween();
	yield 0 - faker()->numberBetween();
	yield 0 - faker()->numberBetween();
	yield 0 - faker()->numberBetween();
	yield 0 - faker()->numberBetween();
});

dataset('random_non_ints', function () {
	yield faker()->randomFloat();
	yield faker()->randomFloat();
	yield faker()->name();
	yield faker()->name();
	yield faker()->password();
	yield faker()->password();
	yield faker()->boolean();
	yield faker()->boolean();
	yield null;
});
