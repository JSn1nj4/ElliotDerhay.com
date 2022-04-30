<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
	// Create some records with, and others without, a demo_link value
	$demo_url = random_int(0, 1) ? $faker->url : null;

	return [
		'name' => $faker->name,
		'link' => $faker->unique()->url,
		'demo_link' => $demo_url,
		'thumbnail' => $faker->imageUrl(600, 338, 'cats'),
		'short_desc' => implode(' ', $faker->words())
	];
});
