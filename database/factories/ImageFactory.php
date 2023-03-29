<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
	protected string $diskName = 'public';
	protected FilesystemAdapter $disk;

	public function __construct(
		$count = null,
		?Collection $states = null,
		?Collection $has = null,
		?Collection $for = null,
		?Collection $afterMaking = null,
		?Collection $afterCreating = null,
		$connection = null,
		?Collection $recycle = null
	) {
		parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection, $recycle);

		$this->disk = Storage::disk($this->diskName);
	}

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
			'disk' => $this->diskName,
			'file_hash' => hash_file(
				algo: config('app.uploads.hash'),
				filename: $this->disk->path($path),
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

		$path = $file->store($collection, $this->diskName);

		return [$file, $path];
	}

	public function setDisk(string $name, FilesystemAdapter|null $disk = null): static
	{
		$this->diskName = $name;

		$this->disk = is_null($disk) ? Storage::disk($this->diskName) : $disk;

		return $this;
	}
}
