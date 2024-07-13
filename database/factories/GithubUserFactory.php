<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GithubUser>
 */
class GithubUserFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition(): array
	{
		$id = fake()->randomNumber(7, true);
		$login = fake()->userName();

		return [
			'id' => $id,
			'login' => $login,
			'display_login' => $login,
			'avatar_url' => "https://avatars.githubusercontent.com/u/{$id}?",
		];
	}
}
