<?php

namespace App\Filament\Resources\ImageResource\Pages;

use App\DataTransferObjects\ImageDTO;
use App\Filament\Resources\ImageResource;
use Filament\Forms;
use Filament\Resources\Pages\CreateRecord;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreateImage extends CreateRecord
{
    protected static string $resource = ImageResource::class;

	public array|null $image = [];
	public string|null $name = null;
	public string|null $collection = null;
	public string|null $disk = null;
	public string|null $file_name = null;
	public string|null $mime_type = null;
	public string|null $path = null;
	public int|null $size = null;
	public string|null $file_hash = null;
}
