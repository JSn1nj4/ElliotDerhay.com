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
		$data = [
			'title' => $this->faker->realText(60),
			'body' => $this->faker->realText(500),
			'published' => $this->faker->boolean(75),
		];

		$data['slug'] = str($data['title'])->slug();
		$data['published_at'] = $data['published']
			? $this->faker->dateTime()
			: null;

        return $data;
    }
}
