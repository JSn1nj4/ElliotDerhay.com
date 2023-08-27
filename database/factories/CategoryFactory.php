<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
	{
        return [
            'title' => $this->faker->unique()->word(),
        ];
    }

    public function configure(): self|Factory
    {
        return $this->afterMaking(static function (Category $category) {
            $category->slug = str($category->title)->slug()->toString();
        });
    }
}
