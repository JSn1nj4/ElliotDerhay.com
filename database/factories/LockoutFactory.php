<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lockout>
 */
class LockoutFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'ip_address' => fake()->unique()->ipv4(),
			'url' => fake()->url(),
			'user_agent' => fake()->userAgent(),
			'content_type' => fake()->randomElement([
				'json',
				'xml',
				'html',
				'text',
			]),
			'credential' => fake()->safeEmail(),
		];
	}
}
