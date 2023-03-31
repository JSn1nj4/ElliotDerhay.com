<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
	{
		DB::table(Image::make()->getTable())
			->truncate();

		Image::factory(10)
			->create();

		foreach (Storage::disk('temp')->allFiles() as $file) {
			Storage::disk('temp')->delete($file);
		}
    }
}
