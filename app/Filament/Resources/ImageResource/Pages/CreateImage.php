<?php

namespace App\Filament\Resources\ImageResource\Pages;

use App\DataTransferObjects\ImageDTO;
use App\Filament\Resources\ImageResource;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CreateImage extends CreateRecord
{
    protected static string $resource = ImageResource::class;

	protected static string|null $title = "Upload Image";

	public array|null $image = null;
	public string|null $name = null;
	public string|null $collection = null;
	public string|null $disk = null;
	public string|null $file_name = null;
	public string|null $mime_type = null;
	public string|null $path = null;
	public int|null $size = null;
	public string|null $file_hash = null;

	public function form(Forms\Form $form): Forms\Form
	{
		return $form
			->columns(1)
			->schema([
				Forms\Components\FileUpload::make('image')
					->maxWidth('4xl')
					->hiddenLabel()
					->image()
					->required()
					->maxSize(5 * 1024)
					->beforeStateDehydrated(function (Forms\Set $set, array|null $state) {
						$file = null;

						foreach ($state as $item) {
							if (!($item instanceof TemporaryUploadedFile)) continue;

							$file = $item;
							break;
						}

						if (!$file) {
							Notification::make()
								->title('Uploaded file not found!')
								->body('Please try again.')
								->danger()
								->send();

							$this->halt();
						}

						$dto = ImageDTO::fromUpload($file);

						$data = [];

						foreach ([
							'name',
							'collection',
							'disk',
							'file_name',
							'mime_type',
							'path',
							'size',
							'file_hash',
					 	] as $field) {
							// $set($field, $dto->{$field});
							$data[$field] = $dto->{$field};
						}

						return $data;
					})
					->reactive(),
			]);
	}

}
