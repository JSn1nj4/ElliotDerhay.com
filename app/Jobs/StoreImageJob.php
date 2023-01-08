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
		$this->hash = hash_file(
			algo: config('app.uploads.hash'),
			filename: Storage::disk('temp')->path($file->store('images', 'temp')),
		);
	}

    public function handle()
    {
		$image = Image::create([
			'name' => "{$this->name}",
			'file_name' => $this->original_name,
			'mime_type' => $this->mime_type,
			'path' => $this->path,
			'disk' => config('app.uploads.disk'),
			'file_hash' => $this->hash,
			'size' => $this->size,
			'collection' => $this->collection,
		]);

		$this->relation
			?->images()
			->attach($image->id);
    }
}
