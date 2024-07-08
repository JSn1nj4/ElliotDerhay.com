<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition(): array
	{
		$title = fake()->realText(60);
		$published = fake()->boolean(75);

		return [
			'title' => fake()->realText(60),
			'body' => fake()->realText(500),
			'slug' => str($title)->slug()->toString(),
		];
	}

	public function published(): static
	{
		return $this->state(static fn (array $attributes): array => [
			'published' => true,
			'published_at' => fake()->dateTime(),
		]);
	}
}
