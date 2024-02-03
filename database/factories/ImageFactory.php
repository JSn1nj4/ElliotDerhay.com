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
	private int|null $timer = null;

	public function __construct(
		$count = null,
		Collection|null $states = null,
		Collection|null $has = null,
		Collection|null $for = null,
		Collection|null $afterMaking = null,
		Collection|null $afterCreating = null,
		$connection = null,
		Collection|null $recycle = null
	) {
		parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection, $recycle);

		$this->disk = Storage::disk($this->diskName);
	}

	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array {
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

	protected function ensureTempDirExists(): void {
		if (Storage::disk('temp')->directoryMissing('')) {
			Storage::disk('temp')->createDirectory('');
		}
	}

	/**
	 * @throws \Exception
	 */
	protected function generateUploadedFile(string $collection = 'images'): array {
		$temp_path = false;

		/**
		 * Stupid hack needed in case $temp_path comes back false for
		 * whatever dumb reason...
		 */
		while ($temp_path === false) {
			$this->timer(); // error out if running too long to prevent disk filling up

			$temp_path = $this->faker
				->unique()
				->image(storage_path('app/temp'));
		}

		$this->resetTimer();

		$file = new UploadedFile(
			path: $temp_path,
			originalName: $this->faker->unique()->firstName() . ".jpg",
			mimeType: "image/jpeg",
		);

		$path = $file->store($collection, $this->diskName);

		return [$file, $path];
	}

	private function resetTimer(): void {
		$this->timer = null;
	}

	public function setDisk(string $name, FilesystemAdapter|null $disk = null): static {
		$this->diskName = $name;

		$this->disk = is_null($disk) ? Storage::disk($this->diskName) : $disk;

		return $this;
	}

	private function timer(int $seconds = (60 * 1)): void {
		$this->timer ??= now()->addSeconds($seconds)->getTimestamp();

		if (now()->getTimestamp() >= $this->timer) {
			throw new \Exception("Task did not complete in allotted time.");
		}
	}
}
