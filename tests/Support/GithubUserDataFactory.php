<?php

namespace Tests\Support;

use Faker\Factory;
use Faker\Generator;

class GithubUserDataFactory extends BaseFactory
{
	private Generator $faker;

	public function __construct()
	{
		$this->faker = fake();

		$this->username = $this->faker->userName();
	}

	private function definition(): array
	{
		return [
			'id' => $this->faker->randomNumber(7, true),
			'login' => $this->username,
			'display_login' => $this->username,
			'avatar_url' => $this->faker->imageUrl(50, 50, 'cats'),
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

	public function withUser(string $username): self
	{
		$this->username = $username;

		return $this;
	}
}
