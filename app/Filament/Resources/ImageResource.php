<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImageResource\Pages;
use App\Filament\Resources\ImageResource\RelationManagers;
use App\Models\Image;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
            'edit' => Pages\EditImage::route('/{record}/edit'),
        ];
    }
}
