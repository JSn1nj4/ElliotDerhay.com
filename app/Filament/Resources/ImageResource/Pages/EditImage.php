<?php

namespace App\Filament\Resources\ImageResource\Pages;

use App\Filament\Resources\ImageResource;
use App\Forms\Components\ImageViewField;
use Filament\Forms;
use Filament\Pages\Actions;
use Filament\Resources\Form;
use Filament\Resources\Pages\EditRecord;

class EditImage extends EditRecord
{
    protected static string $resource = ImageResource::class;

	public function form(Forms\Form $form): Forms\Form
	{
		return $form->columns(3)
			->schema([
				Forms\Components\Section::make('Image')
					->columnSpan(1)
					->columns(1)
					->schema([
						ImageViewField::make('image')
							->disableLabel(),
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
							->disabled(),
					]),
			]);
	}

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
