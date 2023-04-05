<?php

namespace Database\Seeders;

use App\Models\CommandEvent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommandEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
	{
		$this->call([
			CommandSeeder::class,
		]);

        DB::table(CommandEvent::make()->getTable())
			->truncate();

		CommandEvent::factory(50)
			->create();
    }
}
