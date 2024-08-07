<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition(): array
	{
		$title = fake()->unique()->name;

		return [
			'title' => $title,
			'slug' => str($title)->slug()->toString(),
		];
	}
}
