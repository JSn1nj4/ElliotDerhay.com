<?php

it('does not produce a string matching the plain-text password')
	->with('random_passwords')
	->expect(fn (string $password) => hashPassword($password) === $password)
	->toBeFalse();

it('returns a password hash with a standard bcrypt hash length', function (string $password) {
	$hashed = hashPassword($password);

	expect($hashed)
		->toBeString()
		->and(strlen($hashed))
		->toBeGreaterThanOrEqual(59)
		->toBeLessThanOrEqual(60);
})->with('random_passwords');
