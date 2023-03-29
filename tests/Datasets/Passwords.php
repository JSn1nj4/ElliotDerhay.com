<?php

use function Pest\Faker\faker;

dataset('random_passwords', function () {
	yield faker()->password();
	yield faker()->password();
	yield faker()->password();
	yield faker()->password();
	yield faker()->password();
});
