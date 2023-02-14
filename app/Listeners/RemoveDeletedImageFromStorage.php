<?php

namespace App\Listeners;

use App\Events\ImageDeletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class RemoveDeletedImageFromStorage implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(ImageDeletedEvent $event): void
    {
        Storage::disk($event->image->disk)
			->delete($event->image->path);
    }
}
