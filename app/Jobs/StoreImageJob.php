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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class StoreImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	public readonly string $original_name;
	public readonly string $path;
	public readonly string $mime_type;
	public readonly string $name;
	public readonly int $size;

    public function __construct(
		UploadedFile $file,
		public readonly ?ImageableContract $relation = null,
		public readonly string $collection = 'images',
	) {
		$this->name = $file->hashName();
		$this->original_name = $file->getClientOriginalName();
		$this->mime_type = $file->getClientMimeType();
		$this->path = $file->store("images", config('app.uploads.disk'));
		$this->size = $file->getSize();
	}

    public function handle()
    {
		$image = Image::create([
			'name' => "{$this->name}",
			'file_name' => $this->original_name,
			'mime_type' => $this->mime_type,
			'path' => $this->path,
			'disk' => config('app.uploads.disk'),
			'file_hash' => hash_file(
				config('app.uploads.hash'),
				Storage::disk(config('app.uploads.disk'))->path($this->path),
			),
			'size' => $this->size,
			'collection' => $this->collection,
		]);

		$this->relation
			?->images()
			->attach($image->id);
    }
}
