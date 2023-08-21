<?php

namespace App\Filament\Resources\ImageResource\Pages;

use App\Actions\StoresImage;
use App\Filament\Resources\ImageResource;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class UploadImage extends Page
{
    protected static string $resource = ImageResource::class;

    protected static string $view = 'filament.resources.image-resource.pages.upload-image';

	public array|null $image = [];

	public function create(): void
	{
		$file = array_pop($this->image);

		if (!($file instanceof TemporaryUploadedFile)) {
			Notification::make()
				->title('Uploaded file not found')
				->warning()
				->send();

			return;
		}

		$image = StoresImage::execute($file);

		Notification::make()
			->title('Upload complete!')
			->body(sprintf('File "%s" successfully saved!', $image->file_name))
			->success()
			->send();

		$this->redirect(route('filament.admin.resources.images.view', [
			'record' => $image,
		]));
	}

	public function form(Forms\Form $form): Forms\Form
	{
		return $form
			->columns(1)
			->schema([
				Forms\Components\FileUpload::make('image')
					->hiddenLabel()
					->image()
					->required()
					->maxSize(5 * 1024)
					->reactive(),
			]);
	}
}
