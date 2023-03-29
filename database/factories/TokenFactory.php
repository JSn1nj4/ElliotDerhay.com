<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Token>
 */
class TokenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->randomNumber(),
			'service' => $this->faker->randomElement(['twitter']),
			'value' => $this->faker->sha256(),
			'expires_at' => $this->faker->randomElement([null]),
        ];
    }
}
