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
		$this->call([
			CommandEventSeeder::class,
			ImageSeeder::class,
			PostSeeder::class,
			ProjectSeeder::class,
		]);
    }
}
