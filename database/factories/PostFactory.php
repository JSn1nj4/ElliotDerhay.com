<?php

namespace Database\Factories;

use App\Models\Post;
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
			'body' => $this->faker->realText(500),
		];
    }

    public function configure(): self|Factory
    {
        return $this->afterMaking(function (Post $post) {
            $post->slug = str($post->title)->slug()->toString();
			$post->published = $this->faker->boolean(75);
			$post->published_at = $post->published ? $this->faker->dateTime() : null;
        });
    }
}
