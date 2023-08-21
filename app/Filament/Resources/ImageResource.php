<?php

namespace App\Filament\Resources;

use App\DataTransferObjects\ImageDTO;
use App\Filament\Forms\Components\ImageViewField;
use App\Filament\Resources\ImageResource\Pages;
use App\Models\Image;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ImageResource extends Resource
{
    protected static string|null $model = Image::class;

    protected static string|null $navigationIcon = 'm-photo';

	protected static int|null $navigationSort = 1;

	protected static string|null $navigationGroup = 'Content';

	protected static string|null $navigationLabel = 'Image Gallery';

	public array|null $image = [];
	public string|null $name = null;
	// public string|null $collection = null;
	// public string|null $disk = null;
	// public string|null $file_name = null;
	// public string|null $mime_type = null;
	// public string|null $path = null;
	// public int|null $size = null;
	// public string|null $file_hash = null;

    public static function form(Forms\Form $form): Forms\Form
    {
		return $form
			->columns(1)
			->schema([
				Forms\Components\Group::make([
					Forms\Components\Section::make('Preview')
						->columnSpan(1)
						->schema([
							ImageViewField::make('image')->hiddenLabel(),
						]),

					Forms\Components\Section::make('Info')
						->columnSpan(2)
						->columns(3)
						->schema([
							Forms\Components\TextInput::make('name')
								->columnSpanFull()
								->required()
								->maxLength(255),

							Forms\Components\TextInput::make('collection')
								->columnSpan(2)
								->required()
								->maxLength(255)
								->disabled(),

							Forms\Components\TextInput::make('disk')
								->required()
								->maxLength(255)
								->disabled(),

							Forms\Components\TextInput::make('file_name')
								->columnSpan(2)
								->required()
								->maxLength(255)
								->disabled(),

							Forms\Components\TextInput::make('mime_type')
								->required()
								->maxLength(255)
								->disabled(),

							Forms\Components\TextInput::make('path')
								->columnSpan(2)
								->required()
								->maxLength(255)
								->disabled(),

							Forms\Components\TextInput::make('size')
								->numeric()
								->required()
								->integer()
								->disabled(),

							Forms\Components\Hidden::make('file_hash')
								->required()
								->unique()
								->disabled(),
						]),
					])
					->columns(3)
					->hiddenOn('create'),
			]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
			->columns([
				Tables\Columns\ImageColumn::make('url')
					->disk(static fn (Image $image) => $image->disk)
					->size('auto')->height(135),
				Tables\Columns\TextColumn::make('name'),
				Tables\Columns\TextColumn::make('file_name')
					->label('Filename'),
				Tables\Columns\TextColumn::make('mime_type')
					->label('File type'),
				Tables\Columns\TextColumn::make('disk'),
			])
			->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
				Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
				Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListImages::route('/'),
			'create' => Pages\CreateImage::route('/create'),
			'view' => Pages\ViewImage::route('/{record}'),
            'edit' => Pages\EditImage::route('/{record}/edit'),
        ];
    }
}
