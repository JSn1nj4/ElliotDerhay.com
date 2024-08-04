<?php

namespace Database\Seeders;

use App\Models\LoginActivity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoginActivitySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		DB::table(LoginActivity::make()->getTable())->truncate();

		LoginActivity::factory(60)->create();
	}
}
