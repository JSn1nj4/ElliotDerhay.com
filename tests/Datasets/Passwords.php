<?php

use function Pest\Faker\fake;

dataset('random_passwords', function () {
	yield fake()->password();
	yield fake()->password();
	yield fake()->password();
	yield fake()->password();
	yield fake()->password();
});
