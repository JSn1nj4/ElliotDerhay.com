<?php

namespace Database\Seeders;

use App\Models\Lockout;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LockoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(Lockout::make()->getTable())
			->truncate();

		Lockout::factory(30)
			->create();
    }
}
