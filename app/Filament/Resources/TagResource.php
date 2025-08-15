<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TagResource\Pages\CreateTag;
use App\Filament\Resources\TagResource\Pages\EditTag;
use App\Filament\Resources\TagResource\Pages\ListTags;
use App\Filament\Resources\TagResource\RelationManagers\PostsRelationManager;
use App\Models\Tag;
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
use Override;

class TagResource extends Resource
{
	protected static string|null $model = Tag::class;

	protected static string|\BackedEnum|null $navigationIcon = 'm-tag';

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

	#[Override]
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
					->label('Tagged Posts'),
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
			'index' => ListTags::route('/'),
			'create' => CreateTag::route('/create'),
			'edit' => EditTag::route('/{record}/edit'),
		];
	}
}
