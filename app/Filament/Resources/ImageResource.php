<?php

namespace App\Filament\Resources;

use App\DataTransferObjects\ImageDTO;
use App\Filament\Resources\ImageResource\Pages;
use App\Models\Image;
use Filament\Forms;
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

    public static function form(Forms\Form $form): Forms\Form
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
					])->visibleOn('create'),

				Forms\Components\Section::make('Preview')
					->columnSpan(1)
					->schema([

					])->hiddenOn('create'),

				Forms\Components\Section::make('Info')
					->columnSpan(2)
					->columns(3)
					->schema([
						Forms\Components\TextInput::make('name')
							->columnSpanFull()
							->disabledOn('create')->dehydrated(),
						Forms\Components\TextInput::make('collection')
							->columnSpan(2)
							->disabled()->dehydrated(),
						Forms\Components\TextInput::make('disk')
							->disabled()->dehydrated(),
						Forms\Components\TextInput::make('file_name')
							->columnSpan(2)
							->disabled()->dehydrated(),
						Forms\Components\TextInput::make('mime_type')
							->disabled()->dehydrated(),
						Forms\Components\TextInput::make('path')
							->columnSpan(2)
							->disabled()->dehydrated(),
						Forms\Components\TextInput::make('size')
							->numeric()
							->disabled()->dehydrated(),
						Forms\Components\Hidden::make('file_hash')
							->disabled()->dehydrated(),
					]),
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
