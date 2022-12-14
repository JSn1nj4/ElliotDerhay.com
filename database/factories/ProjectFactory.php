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
    public function definition()
    {
		$demo_url = random_int(0, 1) ? $this->faker->url : null;

		return [
			'name' => $this->faker->name,
			'link' => $this->faker->unique()->url,
			'demo_link' => $demo_url,
			'thumbnail' => $this->faker->imageUrl(600, 338, 'cats'),
			'short_desc' => implode(' ', $this->faker->words())
		];
    }
}
