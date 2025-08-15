<?php

namespace App\Filament\Resources\ImageResource\Pages;

use App\Actions\StoresImage;
use App\Filament\Resources\ImageResource;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Schema;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class UploadImage extends Page
{
	protected static string $resource = ImageResource::class;

	protected string $view = 'filament.resources.image-resource.pages.upload-image';

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

	public function form(Schema $schema): Schema
	{
		return $schema
			->columns(1)
			->components([
				FileUpload::make('image')
					->hiddenLabel()
					->image()
					->required()
					->maxSize(5 * 1024)
					->reactive(),
			]);
	}
}
