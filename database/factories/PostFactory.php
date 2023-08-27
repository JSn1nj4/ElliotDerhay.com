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
        return [
			'title' => $this->faker->realText(60),
			'slug' => static fn ($state) => str($state['slug'])->slug()->toString(),
			'body' => $this->faker->realText(500),
			'published' => $this->faker->boolean(75),
			'published_at' => fn ($state) => ($state['published'] ? $this->faker->dateTime() : null),
		];
    }
}
