<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Storage;

class CleanTempStorageJob extends BaseQueueableJob
{
    public function handle(): void
    {
        Storage::disk('temp')->deleteDirectory('');
    }
}
