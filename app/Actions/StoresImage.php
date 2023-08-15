<?php

namespace App\Actions;

use App\Contracts\ImageableContract;
use App\DataTransferObjects\FileLocation;
use App\DataTransferObjects\ImageDTO;
use App\Jobs\TransferImageJob;
use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StoresImage extends BaseAction
{
	protected ImageDTO $dto;

	protected ImageableContract|null $relation;
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
		$this->temp_disk = $temp_disk;

		$this->dto = ImageDTO::fromUpload($file, $collection, $temp_disk);

		$image = $this->getImage();

		$this->maybeAttach($image);

		return $image;
	}

	public static function execute(
		UploadedFile $file,
		ImageableContract|null $relation = null,
		string $collection = 'images',
		string $temp_disk = 'temp',
	): Image
	{
		return self::make()($file, $relation, $collection, $temp_disk);
	}

	protected function getImage(): Image
	{
		return Image::firstOrCreate(['file_hash' => $this->dto->file_hash], [
			'name' => (string)$this->dto->name,
			'file_name' => $this->dto->file_name,
			'mime_type' => $this->dto->mime_type,
			'path' => $this->dto->path,
			'disk' => $this->dto->disk,
			'size' => $this->dto->size,
			'collection' => $this->dto->collection,
		]);
	}

	protected function maybeAttach(Image $image): void
	{
		$this->relation?->images()->sync([$image->id]);
	}
}
