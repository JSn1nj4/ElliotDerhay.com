<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lockout>
 */
class LockoutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'ip_address' => $this->faker->unique()->ipv4(),
			'url' => $this->faker->url(),
			'user_agent' => $this->faker->userAgent(),
			'content_type' => $this->faker->randomElement([
				'json',
				'xml',
				'html',
				'text',
			]),
			'credential' => $this->faker->safeEmail(),
        ];
    }
}
