<?php

namespace App\Filament\Resources;

use App\Actions\StoresImage;
use App\Filament\Forms\Components\ImageViewField;
use App\Filament\Resources\ProjectResource\Pages\CreateProject;
use App\Filament\Resources\ProjectResource\Pages\EditProject;
use App\Filament\Resources\ProjectResource\Pages\ListProjects;
use App\Filament\Traits\HasCountBadge;
use App\Models\Image;
use App\Models\Project;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ProjectResource extends Resource
{
	use HasCountBadge;

	protected static string|null $model = Project::class;

	protected static string|\BackedEnum|null $navigationIcon = 'm-code-bracket';

	protected static string|\UnitEnum|null $navigationGroup = 'Content';

	protected static string|null $recordTitleAttribute = 'name';

	protected static int|null $navigationSort = 0;

	public int|null $image_id = null;

	public static function form(Schema $schema): Schema
	{
		return $schema->columns(3)
			->components([
				Section::make('Image')
					->columnSpan(1)
					->schema([
						ImageViewField::make('image')
							->hiddenOn('create')
							->hiddenLabel(),

						FileUpload::make('upload')
							->image()
							->maxSize(5 * 1024)
							->afterStateUpdated(static function (Set $set, TemporaryUploadedFile $state) {
								$image = StoresImage::execute($state);

								$set('image_id', $image->id);
							})
							->reactive()
							->hiddenLabel(),

						Hidden::make('image_id'),
					]),

				Section::make('Info')
					->columnSpan(2)
					->columns()
					->schema([
						TextInput::make('name')
							->columnSpanFull()
							->required()
							->maxLength(255),

						TextInput::make('link')
							->required()
							->url()
							->maxLength(255)
							->unique(ignoreRecord: true)
							->label('Project link'),

						TextInput::make('demo_link')
							->url()
							->maxLength(255),

						Textarea::make('short_desc')
							->columnSpanFull()
							->required()
							->maxLength(255),
					])
					->saveRelationshipsUsing(static function (Project $project, Get $get) {
						$image_id = $get('image_id');

						if ($image_id === null) return;

						if (Image::whereId($image_id)->doesntExist()) return;

						$project->images()->sync([$image_id]);
					}),
			]);
	}

	public static function table(Table $table): Table
	{
		return $table
			->defaultSort('created_at', 'desc')
			->columns([
				ImageColumn::make('image.url')
					->disk(static fn (Image $image) => $image->disk)
					->size('auto')->height(135),
				TextColumn::make('name')
					->searchable(),
				TextColumn::make('link'),
				TextColumn::make('demo_link'),
			])
			->filters([
				//
			])
			->recordActions([
				EditAction::make(),
				DeleteAction::make(),
			])
			->toolbarActions([
				DeleteBulkAction::make(),
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
			'index' => ListProjects::route('/'),
			'create' => CreateProject::route('/create'),
			'edit' => EditProject::route('/{record}/edit'),
		];
	}
}
