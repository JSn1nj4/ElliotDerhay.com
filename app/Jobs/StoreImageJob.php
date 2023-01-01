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

    public function __construct(
		public readonly UploadedFile $file,
		public readonly ?ImageableContract $relation = null,
	) {}

    public function handle()
    {
		$name = $this->file->hashName();

		$upload = Storage::put("{$name}", $this->file);

		$image = Image::create([
			'name' => "{$name}",
			'file_name' => $this->file->getClientOriginalName(),
			'mime_type' => $this->file->getClientMimeType(),
			'path' => $upload->path(),
			'disk' => config('app.uploads.disk'),
			'file_hash' => hash_file(
				config('app.uploads.hash'),
				storage_path("images/{$name}"),
			),
			'collection' => 'images',
		]);

		$this->relation
			?->images()
			->attach($image->id);
    }
}
