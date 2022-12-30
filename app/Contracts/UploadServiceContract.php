<?php

namespace App\Contracts;

use App\DataTransferObjects\File;
use Illuminate\Http\UploadedFile;

interface UploadServiceContract
{
	public function image(UploadedFile $file): File;
}
