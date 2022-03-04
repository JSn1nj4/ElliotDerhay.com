<?php

namespace Tests\Support;

use Faker\Factory;
use Faker\Generator;

class TwitterUserDataFactory extends BaseFactory
{
	private Generator $faker;

	private string $name;

	public function __construct()
	{
		$this->faker = Factory::create();

		$this->name = $this->faker->name();

		$this->username = $this->faker->userName();
	}

	private function definition(): array
	{
		return [
			'id' => (int)$this->faker->regexify('[1-9][0-9]{9}'),
			'name' => $this->name,
			'screen_name' => $this->username,
			'profile_image_url_https' => $this->faker->imageUrl(48, 48, 'cat'),
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

	public function makeOne(): array
	{
		return $this->definition();
	}

	public function withUser(string $username, string $name = null): self
	{
		$this->username = $username;

		$this->name ??= $name;

		return $this;
	}
}
