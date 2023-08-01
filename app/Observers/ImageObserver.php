<?php

namespace App\Observers;

use App\Actions\MoveImage;
use App\DataTransferObjects\FileLocation;
use App\Jobs\TransferImageJob;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

final class ImageObserver
{
	/**
	 * Pre-process Image model data via the "creating" event.
	 * @param \App\Models\Image $image
	 * @return void
	 * @throws \Exception
	 */
	public function creating(Image $image): void
	{
		if ($image->disk !== config('app.uploads.temp')) return;

		$permanent_path = "{$image->collection}/{$image->name}";

		$result = MoveImage::execute(
			from: new FileLocation(config('app.uploads.temp'), $image->path),
			to: new FileLocation('public', $permanent_path)
		);

		if (!$result->succeeded) throw new \Exception($result->message);

		$image->disk = 'public';
		$image->path = $permanent_path;
	}

    /**
     * Handle the Image "created" event.
     */
    public function created(Image $image): void
    {
		TransferImageJob::dispatch($image->id, config('app.uploads.disk'));
    }

    /**
     * Model cleanup on "deleted" event.
     */
    public function deleted(Image $image): void
    {
		Storage::disk($image->disk)->delete($image->path);
    }

    /**
     * Model cleanup on "force deleted" event.
     */
    public function forceDeleted(Image $image): void
    {
		Storage::disk($image->disk)->delete($image->path);
    }
}
