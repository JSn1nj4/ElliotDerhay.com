<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition(): array
	{
		return [
			'title' => fake()->unique()->name,
		];
	}

	public function configure(): self|Factory
	{
		return $this->afterMaking(static function (Tag $tag) {
			$tag->slug = str($tag->title)->slug()->toString();
		});
	}
}
