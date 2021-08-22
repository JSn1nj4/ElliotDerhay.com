<?php

namespace Tests\Support;

class TweetDataFactory extends BaseFactory
{
	private \Faker\Generator $faker;

	public function __construct()
	{
		$this->faker = \Faker\Factory::create();
	}

	private function definition(): array
	{
		$user = $this->username ?? $this->faker->userName();

		return [
			'id' => (int)$this->faker->numerify('####################'),
			'user' => [
				'id' => (int)$this->faker->numerify('##########'),
				'name' => $user,
				'screen_name' => $user,
				'profile_image_url_https' => $this->faker->imageUrl(48, 48, 'cat'),
			],
			'text' => $this->faker->paragraph(),
			'created_at' => now()->toRfc822String(),
			'entities' => [],
		];
	}

	public function make(): array
	{
		$data = [];

		for ($i = 0; $i < $this->count; $i++) {
			array_push($data, $this->definition());
		}

		return $data;
	}
}
