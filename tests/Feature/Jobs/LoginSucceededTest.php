<?php

use App\Jobs\LoginSucceeded;
use App\Models\LoginActivity;

it('logs successful login activity', function () {
	expect(LoginActivity::count())->toEqual(0);

	LoginSucceeded::dispatch(fake()->email, fake()->ipv4);

	expect(LoginActivity::count())->toEqual(1);
});
