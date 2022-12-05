<?php

namespace Database\Factories;

use App\Models\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommandEvent>
 */
class CommandEventFactory extends Factory
{
	/**
	 * @return array|mixed[]
	 * @throws \Throwable
	 */
    public function definition(): array
    {
		/**
		 * @var Collection|Command[] $commands
		 */
		$commands = Command::all();

		throw_if($commands->count() === 0, new \Exception('Commands table is empty. Please fill commands table before generating fake events.'));

        return [
            'command_id' => $commands->random()->id,
			'succeeded' => $this->faker->boolean(),
        ];
    }
}
