<?php

namespace App\Filament\Resources;

use App\Filament\Forms\Components\ImageViewField;
use App\Filament\Resources\ImageResource\Pages;
use App\Models\Image;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class ImageResource extends Resource
{
    protected static string|null $model = Image::class;

    protected static string|null $navigationIcon = 'm-photo';

	protected static int|null $navigationSort = 1;

	protected static string|null $navigationGroup = 'Content';

	protected static string|null $navigationLabel = 'Image Gallery';

	protected static string|null $recordTitleAttribute = 'name';

	public array|null $image = [];
	public string|null $name = null;

    public static function form(Forms\Form $form): Forms\Form
    {
		return $form
			->columns(1)
			->schema([
				Forms\Components\Group::make([
					Forms\Components\Section::make('Preview')
						->columnSpan(1)
						->schema([
							ImageViewField::make('image')
								->dehydrated(false)
								->hiddenLabel(),
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
								->unique(ignoreRecord: true)
								->disabled(),
						]),
					])
					->columns(3),
			]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
			->defaultSort('created_at', 'desc')
			->columns([
				Tables\Columns\ImageColumn::make('url')
					->disk(static fn (Image $image) => $image->disk)
					->size('auto')->height(135)
					->label('Preview'),
				Tables\Columns\TextColumn::make('name')
					->searchable(),
				Tables\Columns\TextColumn::make('file_name')
					->searchable()
					->toggleable()
					->label('Filename'),
				Tables\Columns\TextColumn::make('mime_type')
					->toggleable(isToggledHiddenByDefault: true)
					->label('File type'),
				Tables\Columns\TextColumn::make('disk')
					->toggleable(),
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
			'create' => Pages\UploadImage::route('/create'),
			'view' => Pages\ViewImage::route('/{record}'),
            'edit' => Pages\EditImage::route('/{record}/edit'),
        ];
    }
}
