<?php

use function Pest\Faker\faker;

dataset('random_objects', function () {
	yield faker()->dateTime();
	yield faker()->dateTimeInInterval();
	yield faker()->timezone();
	yield new stdClass();
});
