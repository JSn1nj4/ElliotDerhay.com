<?php

use function Pest\Faker\fake;

dataset('random_objects', function () {
	yield fake()->dateTime();
	yield fake()->dateTimeInInterval();
	yield fake()->timezone();
	yield new stdClass();
});
