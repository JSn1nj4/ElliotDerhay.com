<?php

use App\Actions\LogUserLogin;
use App\Models\User;

it('throws an integrity constraint violation if logging an event for a user that does not exist', function () {
	invoke(LogUserLogin::class, [
		User::factory()->makeOne()
	]);
})->throws('Integrity constraint violation');

it('logs a login event for an existing user', function () {
	$user = User::factory()->createOne();
	$user->loadCount('logins');

	expect($user->logins_count)
		->toEqual(0);

	$login = invoke(LogUserLogin::class, [
		$user
	]);

	$user->loadCount('logins');
	$user->load('logins');

	expect($user->logins_count)
		->toEqual(1)
		->and($user->logins->contains($login))
		->toBeTrue()
		->and($login->user->id)
		->toEqual($user->id);
});
