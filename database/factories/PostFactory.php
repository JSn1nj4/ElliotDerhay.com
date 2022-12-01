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
    public function definition()
    {
		$data = [
			'title' => $this->faker->realText(60),
			'body' => $this->faker->realText(500),
			'cover_image' => $this->faker->imageUrl(1920, 900),
		];

		$data['slug'] = str($data['title'])->slug();

        return $data;
    }
}
