<?php

use App\Jobs\LoginFailed;
use App\Models\LoginActivity;

it('logs failed login activity', function () {
	expect(LoginActivity::count())->toEqual(0);

	LoginFailed::dispatch(fake()->email, fake()->sentence, fake()->ipv4);

	expect(LoginActivity::count())->toEqual(1);
});
