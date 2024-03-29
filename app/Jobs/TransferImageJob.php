<?php

namespace App\Jobs;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class TransferImageJob extends BaseQueueableJob
{
    public function __construct(
		public int $image_id,
		public string $new_disk,
	) {}

    public function handle(): void
    {
		try {
        	$image = Image::findOrFail($this->image_id);
		} catch	(\Throwable $e) {
			$this->fail($e);
		}

		if ($image->disk === $this->new_disk) return;

		$completed = Storage::disk($this->new_disk)
				->writeStream($image->path, Storage::disk($image->disk)
					->readStream($image->path));

		// Prevent updating the image model if copying the file failed
		if (!$completed) {
			$this->fail(new \Exception(
				"Failed to transfer image '{$this->image_id}' from disk '{$image->disk}' to '{$this->new_disk}'."
			));

			return;
		}

		$old_disk = $image->disk;

		$image->update([
			'disk' => $this->new_disk,
		]);

		Storage::disk($old_disk)->delete($image->path);
    }
}
