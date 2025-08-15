<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages\CreateCategory;
use App\Filament\Resources\CategoryResource\Pages\EditCategory;
use App\Filament\Resources\CategoryResource\Pages\ListCategories;
use App\Filament\Resources\CategoryResource\RelationManagers\PostsRelationManager;
use App\Models\Category;
use App\Support\Sanitizer;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
	protected static string|null $model = Category::class;

	protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

	protected static string|\UnitEnum|null $navigationGroup = 'Content';

	protected static int|null $navigationSort = 2;

	public static function form(Schema $schema): Schema
	{
		return $schema
			->components([
				TextInput::make('title')
					->required()
					->maxLength(180)
					->live(500)
					->afterStateUpdated(static function (Get $get, Set $set, string|null $state) {
						$slug = str($get('slug'))->trim();

						if (!in_array($slug, [null, ''])) return;

						$set('slug', Sanitizer::slug($state)->toString());
					}),

				TextInput::make('slug')
					->required()
					->unique(ignoreRecord: true)
					->maxLength(255)
					->alphaDash()
					->live(500)
					->afterStateUpdated(static function (Get $get, Set $set, string|null $state) {
						$set('slug', Sanitizer::slug(match (trim($state)) {
							null, '' => $get('title'),
							default => $state
						})->toString());
					}),
			]);
	}

	public static function getNavigationBadge(): string|null
	{
		return self::getModel()::count();
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				TextColumn::make('title')
					->searchable(),
				TextColumn::make('slug')
					->searchable(),
				TextColumn::make('posts_count')
					->counts('posts')
					->label('Categorized Posts'),
				TextColumn::make('created_at')
					->dateTime()
					->sortable()
					->toggleable(isToggledHiddenByDefault: true),
				TextColumn::make('updated_at')
					->dateTime()
					->sortable()
					->toggleable(isToggledHiddenByDefault: true),
			])
			->filters([
				//
			])
			->recordActions([
				EditAction::make(),
			])
			->toolbarActions([
				BulkActionGroup::make([
					DeleteBulkAction::make(),
				]),
			]);
	}

	public static function getRelations(): array
	{
		return [
			PostsRelationManager::class,
		];
	}

	public static function getPages(): array
	{
		return [
			'index' => ListCategories::route('/'),
			'create' => CreateCategory::route('/create'),
			'edit' => EditCategory::route('/{record}/edit'),
		];
	}
}
