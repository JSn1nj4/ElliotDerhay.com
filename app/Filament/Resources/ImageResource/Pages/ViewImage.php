<?php

namespace App\Filament\Resources\ImageResource\Pages;

use App\Filament\Resources\ImageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewImage extends ViewRecord
{
    protected static string $resource = ImageResource::class;

	public string|null $name = null;
	public string|null $collection = null;
	public string|null $disk = null;
	public string|null $file_name = null;
	public string|null $mime_type = null;
	public string|null $path = null;
	public int|null $size = null;
	public string|null $file_hash = null;

	protected function getActions(): array
	{
		return [
			Actions\EditAction::make(),
			Actions\DeleteAction::make(),
		];
	}
}
