<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$demo_url = random_int(0, 1) ? fake()->url : null;

		return [
			'name' => fake()->name,
			'link' => fake()->unique()->url,
			'demo_link' => $demo_url,
			'short_desc' => implode(' ', fake()->words())
		];
	}
}
