<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
	/**
	 * List project data to seed database with
	 */
	private array $project_list = [
		[
			'name' => 'ElliotDerhay.com',
			'link' => 'https://github.com/JSn1nj4/ElliotDerhay.com',
			'demo_link' => 'https://elliotderhay.com',
			'short_desc' => 'My personal website project built with Laravel, Tailwind CSS, and some Vue.js',
		],
		[
			'name' => 'Frontend Stuff',
			'link' => 'https://github.com/JSn1nj4/frontend-stuff',
			'demo_link' => 'https://festuff.elliotderhay.com',
			'short_desc' => 'A small frontend utilities and other experiments project built on Nuxt',
		]
	];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		DB::table(Project::make()->getTable())
			->truncate();

		collect($this->project_list)
			->each(fn ($item, $key) => Project::create($item));
	}
}
