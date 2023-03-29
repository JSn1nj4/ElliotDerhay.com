<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		if (app()->environment('production')) {
			throw new \Exception("This seeder must not be run in Production! It will likely destroy live data.");
		}

		$this->call([
			CommandEventSeeder::class,
			ImageSeeder::class,
			PostSeeder::class,
			ProjectSeeder::class,
		]);
    }
}
