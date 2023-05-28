<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table(User::make()->getTable())
			->truncate();

		User::factory()->createOne([
			'name' => 'Developer',
			'email' => 'dev@elliotderhay.local',
		]);
    }
}
