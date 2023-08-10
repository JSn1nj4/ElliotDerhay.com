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


	public function form(Forms\Form $form): Forms\Form
	{
		return $form->columns(3)
			->schema([
				Forms\Components\Section::make('Upload')
					->columnSpan(1)
					->schema([
						Forms\Components\FileUpload::make('image')
							->hiddenLabel()
							->image()
							->afterStateUpdated(static function (Forms\Set $set, TemporaryUploadedFile $state) {
								$dto = ImageDTO::fromUpload($state);

								$set('name', $dto->name);
								$set('collection', $dto->collection);
								$set('disk', $dto->disk);
								$set('file_name', $dto->file_name);
								$set('mime_type', $dto->mime_type);
								$set('path', $dto->path);
								$set('size', $dto->size);
								$set('file_hash', $dto->file_hash);
							})
							->reactive()
					]),
				Forms\Components\Section::make('Info')
					->columnSpan(2)
					->columns(3)
					->schema([
						Forms\Components\TextInput::make('name')
							->columnSpanFull(),
						Forms\Components\TextInput::make('collection')
							->columnSpan(2)
							->disabled(),
						Forms\Components\TextInput::make('disk')
							->disabled(),
						Forms\Components\TextInput::make('file_name')
							->columnSpan(2)
							->disabled(),
						Forms\Components\TextInput::make('mime_type')
							->disabled(),
						Forms\Components\TextInput::make('path')
							->columnSpan(2)
							->disabled(),
						Forms\Components\TextInput::make('size')
							->numeric()
							->disabled(),
						Forms\Components\Hidden::make('file_hash')
							->disabled(),
					]),
			]);
	}
}
