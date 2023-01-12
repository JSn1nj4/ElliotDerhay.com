<?php

namespace App\Jobs;

use App\Contracts\ImageableContract;
use App\Models\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class StoreImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	public readonly string $hash;
	public readonly string $original_name;
	public readonly string $mime_type;
	public readonly string $name;
	public readonly int $size;
	public readonly string $temp_path;

    public function __construct(
		UploadedFile $file,
		public readonly ?ImageableContract $relation = null,
		public readonly string $collection = 'images',
		public readonly string $temp_disk = "temp",
	) {
		$this->name = $file->hashName();
		$this->original_name = $file->getClientOriginalName();
		$this->mime_type = $file->getClientMimeType();
		$this->temp_path = $file->store($this->collection, $this->temp_disk);
		$this->size = $file->getSize();
		$this->hash = hash_file(
			algo: config('app.uploads.hash'),
			filename: Storage::disk($this->temp_disk)->path($this->temp_path),
		);
	}

	public function attach(Image $image): void
	{
		if ($this->relation->images->contains($image->id)) {
			$this->relation->images()->detach($image->id);
		}

		$this->relation->images()->attach($image->id);
	}

	public function getImage(): Image
	{
		$image = Image::whereFileHash($this->hash)->first();

		if ($image !== null) {
			Storage::disk($this->temp_disk)->delete($this->temp_path);

			return $image;
		}

		return Image::create([
			'name' => "{$this->name}",
			'file_name' => $this->original_name,
			'mime_type' => $this->mime_type,
			'path' => $this->moveToPublic(),
			'disk' => 'public',
			'file_hash' => $this->hash,
			'size' => $this->size,
			'collection' => $this->collection,
		]);
	}

	public function moveToPublic(): string
	{
		$path = "{$this->collection}/{$this->name}";

		if (!Storage::disk('public')
			->writeStream($path, Storage::disk($this->temp_disk)
				->readStream($this->temp_path))) {
			throw new \Exception("Unable to write file '{$this->temp_path}' to public disk.");
		}

		return $path;
	}

    public function handle(): void
    {
		$image = $this->getImage();

		if ($this->relation === null) return;

		$this->attach($image);

		TransferImageJob::dispatch($image->id, config('app.uploads.disk'));
    }
}
