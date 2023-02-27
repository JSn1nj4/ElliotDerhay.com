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

		$this->ensureTempDirExists();

		[$file, $path] = $this->generateUploadedFile($collection);

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

	protected function ensureTempDirExists(): void
	{
		if (Storage::disk('temp')->directoryMissing('')) {
			Storage::disk('temp')->createDirectory('');
		}
	}

	protected function generateUploadedFile(string $collection = 'images'): array
	{
		$file = new UploadedFile(
			path: $this->faker
				->unique()
				->image(storage_path('app/temp')),
			originalName: $this->faker->unique()->firstName() . ".jpg",
			mimeType: "image/jpeg",
		);

		$path = $file->store($collection, 'public');

		return [$file, $path];
	}
}
