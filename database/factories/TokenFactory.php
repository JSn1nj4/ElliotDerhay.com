<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Token>
 */
class TokenFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition(): array
	{
		return [
			'id' => fake()->randomNumber(),
			'service' => fake()->randomElement(['twitter']),
			'value' => fake()->sha256(),
			'expires_at' => fake()->randomElement([null]),
		];
	}
}
