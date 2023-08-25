<?php

namespace App\Jobs;

use App\Actions\MoveImage;
use App\Contracts\ImageableContract;
use App\DataTransferObjects\FileLocation;
use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StoreImageJob extends BaseSyncJob
{
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
		$this->relation->images()->sync([$image->id]);
	}

	public function deleteTempFile(): void
	{
		Storage::disk($this->temp_disk)->delete($this->temp_path);
	}

	public function getImage(): Image
	{
		$image = Image::whereFileHash($this->hash)->first();

		if ($image !== null) return $image;

		return Image::create([
			'name' => "{$this->name}",
			'file_name' => $this->original_name,
			'mime_type' => $this->mime_type,
			'path' => $this->temp_path,
			'disk' => 'public',
			'file_hash' => $this->hash,
			'size' => $this->size,
			'collection' => $this->collection,
		]);
	}

	public function handle(): void
	{
		$image = $this->getImage();

		if ($this->relation === null) return;

		$this->attach($image);

		$this->deleteTempFile();
	}
}
