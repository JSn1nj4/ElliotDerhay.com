<?php

namespace App\Actions;

use App\Contracts\ImageableContract;
use App\Jobs\TransferImageJob;
use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StoresImage extends BaseAction
{
	protected string $collection;
	protected string $hash;
	protected string $mime_type;
	protected string $name;
	protected string $original_name;
	protected ImageableContract|null $relation;
	protected int $size;
	protected string $temp_disk;
	protected string $temp_path;

	/**
	 * @param \Illuminate\Http\UploadedFile $file
	 * @param \App\Contracts\ImageableContract|null $relation
	 * @param string $collection
	 * @param string $temp_disk
	 * @return \App\Models\Image
	 */
	public function __invoke(
		UploadedFile $file,
		ImageableContract|null $relation = null,
		string $collection = 'images',
		string $temp_disk = 'temp',
	): Image
	{
		$this->relation = $relation;
		$this->collection = $collection;
		$this->temp_disk = $temp_disk;

		$this->name = $file->hashName();
		$this->original_name = $file->getClientOriginalName();
		$this->mime_type = $file->getClientMimeType();
		$this->temp_path = $file->store($this->collection, $this->temp_disk);
		$this->size = $file->getSize();
		$this->hash = hash_file(
			algo: config('app.uploads.hash'),
			filename: Storage::disk($this->temp_disk)->path($this->temp_path),
		);

		$image = $this->getImage();

		if ($this->relation === null) return $image;

		$this->maybeAttach($image);

		$this->deleteTempFile();

		TransferImageJob::dispatch($image->id, config('app.uploads.disk'));

		return $image;
	}

	protected function getImage(): Image
	{
		$image = Image::whereFileHash($this->hash)->first();

		if ($image !== null) return $image;

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

	protected function maybeAttach(Image $image): void
	{
		$this->relation?->images()->sync([$image->id]);
	}

	protected function deleteTempFile(): void
	{
		Storage::disk($this->temp_disk)->delete($this->temp_path);
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
}
