<?php

namespace App\Filament\Resources\ImageResource\Pages;

use App\DataTransferObjects\ImageDTO;
use App\Filament\Resources\ImageResource;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Pages\CreateRecord;
use Livewire\TemporaryUploadedFile;

class CreateImage extends CreateRecord
{
    protected static string $resource = ImageResource::class;

	public function form(Forms\Form $form): Forms\Form
	{
		return $form->columns(3)
			->schema([
				Forms\Components\Section::make('Upload')
					->columnSpan(1)
					->schema([
						Forms\Components\FileUpload::make('image')
							->disableLabel()
							->image()
							->reactive()
							->afterStateUpdated(fn ($set, $state) => $this->updateForm($set, $state)),
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

	protected function updateForm(Forms\Set $set, TemporaryUploadedFile $file): void
	{
		$dto = ImageDTO::fromUpload($file);

		$set('name', $dto->name);
		$set('collection', $dto->collection);
		$set('disk', $dto->disk);
		$set('file_name', $dto->file_name);
		$set('mime_type', $dto->mime_type);
		$set('path', $dto->path);
		$set('size', $dto->size);
		$set('file_hash', $dto->file_hash);
	}
}
