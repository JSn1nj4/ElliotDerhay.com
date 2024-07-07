<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TwitterUser>
 */
class TwitterUserFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition(): array
	{
		return [
			'id' => (int)fake()->numerify('##########'),
			'name' => fake()->name(),
			'screen_name' => fake()->userName(),
			'profile_image_url_https' => fake()->imageUrl(48, 48, 'cat'),
		];
	}
}
