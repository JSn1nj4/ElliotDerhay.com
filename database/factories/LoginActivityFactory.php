<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoginActivity>
 */
class LoginActivityFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'email' => fake()->email,
			'succeeded' => fake()->boolean,
			'info' => fake()->sentence,
			'ip_address' => fake()->ipv4,
		];
	}
}
