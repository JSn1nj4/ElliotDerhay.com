<?php

namespace App\Filament\Resources;

use App\Actions\StoresImage;
use App\Filament\Forms\Components\ImageViewField;
use App\Filament\Resources\ProjectResource\Pages;
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

	protected static string|null $navigationGroup = 'Content';

	public int|null $image_id = null;

	public static function form(Forms\Form $form): Forms\Form
	{
        return $form->columns(3)
            ->schema([
				Forms\Components\Section::make('Image')
					->columnSpan(1)
					->schema([
						ImageViewField::make('image')
							->hiddenOn('create')
							->hiddenLabel(),

						Forms\Components\FileUpload::make('upload')
							->image()
							->maxSize(5 * 1024)
							->afterStateUpdated(static function (Forms\Set $set, TemporaryUploadedFile $state) {
								$image = StoresImage::execute($state);

								$set('image_id', $image->id);
							})
							->reactive()
							->hiddenLabel(),

						Forms\Components\Hidden::make('image_id'),
					]),

				Forms\Components\Section::make('Info')
					->columnSpan(2)
					->columns()
					->schema([
						Forms\Components\TextInput::make('name')
							->columnSpanFull()
							->required()
							->maxLength(255),

						Forms\Components\TextInput::make('link')
							->required()
							->url()
							->maxLength(255)
							->unique(ignoreRecord: true)
							->label('Project link'),

						Forms\Components\TextInput::make('demo_link')
							->url()
							->maxLength(255),

						Forms\Components\Textarea::make('short_desc')
							->columnSpanFull()
							->required()
							->maxLength(255),
					])
					->saveRelationshipsUsing(static function (Project $project, Forms\Get $get) {
						$image_id = $get('image_id');

						if ($image_id === null) return;

						if (Image::whereId($image_id)->doesntExist()) return;

						$project->images()->sync([$image_id]);
					}),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
	{
        return $table
            ->columns([
				Tables\Columns\ImageColumn::make('image.url')
					->disk(static fn (Image $image) => $image->disk)
					->size('auto')->height(135),
                Tables\Columns\TextColumn::make('name')
					->searchable(),
				Tables\Columns\TextColumn::make('link'),
				Tables\Columns\TextColumn::make('demo_link'),
            ])
			->defaultSort('created_at', 'desc')
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
