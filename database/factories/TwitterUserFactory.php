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
			'id' => (int)$this->faker->numerify('##########'),
			'name' => $this->faker->name(),
			'screen_name' => $this->faker->userName(),
			'profile_image_url_https' => $this->faker->imageUrl(48, 48, 'cat'),
        ];
    }
}
