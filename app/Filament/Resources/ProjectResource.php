<?php

namespace App\Filament\Resources;

use App\Actions\StoresImage;
use App\Filament\Forms\Components\ImageViewField;
use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Image;
use App\Models\Project;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ProjectResource extends Resource
{
    protected static string|null $model = Project::class;

    protected static string|null $navigationIcon = 'm-code-bracket';

	protected static int|null $navigationSort = 0;

	protected static string|null $navigationGroup = 'Content';

	public static function form(Forms\Form $form): Forms\Form
	{
        return $form->columns(3)
            ->schema([
				Forms\Components\Section::make('Image')
					->columnSpan(1)
					->schema([
						ImageViewField::make('image'),
						Forms\Components\FileUpload::make('image')
							->hiddenLabel()
							->image(),
					]),
				Forms\Components\Section::make('Info')
					->columnSpan(2)
					->columns()
					->schema([
						Forms\Components\TextInput::make('name')
							->columnSpanFull()
							->required(),
						Forms\Components\TextInput::make('link')
							->label('Project link')
							->required(),
						Forms\Components\TextInput::make('demo_link'),
						Forms\Components\Textarea::make('short_desc')
							->columnSpanFull()
							->required(),
					]),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
	{
        return $table
            ->columns([
				Tables\Columns\ImageColumn::make('image.url')
					->disk(static fn (Image $image) => $image->disk)
					->size('auto')->height(135),
                Tables\Columns\TextColumn::make('name'),
				Tables\Columns\TextColumn::make('link'),
				Tables\Columns\TextColumn::make('demo_link'),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
