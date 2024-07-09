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

		return [
			'title' => $title,
			'body' => fake()->realText(500),
			'slug' => str($title)->slug()->toString(),
		];
	}

	public function maybePublished(int $chancePercent = 50): static
	{
		$published = fake()->boolean($chancePercent);

		return $this->state([
			'published' => $published,
			'published_at' => $published ? fake()->dateTime() : null,
		]);
	}

	public function published(): static
	{
		return $this->state([
			'published' => true,
			'published_at' => fake()->dateTime(),
		]);
	}
}
