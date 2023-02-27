<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
		$collection = "images";

		if (Storage::disk('temp')->directoryMissing('')) {
			Storage::disk('temp')->createDirectory('');
		}

		$temp_image = $this->faker
			->unique()
			->image(storage_path('app/temp'));

		$file = new UploadedFile(
			path: $temp_image,
			originalName: $this->faker->unique()->firstName() . ".jpg",
			mimeType: "image/jpeg",
		);

		$path = $file->store($collection, 'public');

        return [
            'name' => $this->faker->name(),
			'file_name' => $file->getClientOriginalName(),
			'mime_type' => $file->getClientMimeType(),
			'path' => $path,
			'disk' => 'public',
			'file_hash' => hash_file(
				algo: config('app.uploads.hash'),
				filename: Storage::disk('public')->path($path),
			),
			'collection' => $collection,
			'size' => $file->getSize(),
        ];
    }
}
