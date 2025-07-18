<?php

namespace Database\Factories;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends BaseFactory
{
	protected string $diskName = 'public';
	protected Filesystem $disk;
	private int|null $timer = null;

	protected bool $fakeFileInfo = false;

	public function __construct(
		$count = null,
		Collection|null $states = null,
		Collection|null $has = null,
		Collection|null $for = null,
		Collection|null $afterMaking = null,
		Collection|null $afterCreating = null,
		$connection = null,
		Collection|null $recycle = null
	)
	{
		parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection, $recycle);

		$this->disk = Storage::disk($this->diskName);
	}

	#[\Override]
	public function definition(): array
	{
		$collection = "images";

		if ($this->fakeFileInfo) {
			$filename = $this->filename(true);

			return [
				'name' => fake()->name(),
				'file_name' => $filename->toString(),
				'mime_type' => match ($filename->afterLast('.')->toString()) {
					'jpg' => 'image/jpeg',
					'webp' => 'image/webp',
				},
				'path' => $filename->prepend(storage_path('app/temp')),
				'disk' => $this->diskName,
				'file_hash' => hash(config('app.uploads.hash'), fake()->sentence()),
				'collection' => $collection,
				'size' => fake()->numberBetween(788, 32_000),
			];
		}

		$this->ensureTempDirExists();

		[$file, $path] = $this->generateUploadedFile($collection);

		return [
			'name' => fake()->name(),
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

	/**
	 * @throws \Exception
	 */
	protected function generateUploadedFile(string $collection = 'images'): array
	{
		$temp_path = false;

		/**
		 * Stupid hack needed in case $temp_path comes back false for
		 * whatever dumb reason...
		 */
		while ($temp_path === false) {
			$this->timer(); // error out if running too long to prevent disk filling up

			$temp_path = fake()
				->unique()
				->image(storage_path('app/temp'), format: 'jpeg');
		}

		$this->resetTimer();

		$file = new UploadedFile(
			path: $temp_path,
			originalName: fake()->unique()->firstName() . ".jpg",
			mimeType: "image/jpeg",
		);

		$path = $file->store($collection, $this->diskName);

		return [$file, $path];
	}

	private function resetTimer(): void
	{
		$this->timer = null;
	}

	public function setDisk(string $name, Filesystem|null $disk = null): static
	{
		$this->diskName = $name;

		$this->disk = $disk ?? Storage::disk($this->diskName);

		return $this;
	}

	private function timer(int $seconds = (60 * 1)): void
	{
		$this->timer ??= now()->addSeconds($seconds)->getTimestamp();

		if (now()->getTimestamp() >= $this->timer) {
			throw new \Exception("Task did not complete in allotted time.");
		}
	}

	/**
	 * @return static
	 */
	public function fakeFileInfo(): static
	{
		$this->fakeFileInfo = true;

		return $this;
	}

	public function exists(): static
	{
		$this->steps[] = static function (Model $model) {
			$model->exists = true;

			return $model;
		};

		return $this;
	}
}
