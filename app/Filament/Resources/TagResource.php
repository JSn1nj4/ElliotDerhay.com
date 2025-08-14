<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TagResource\Pages;
use App\Filament\Resources\TagResource\RelationManagers;
use App\Models\Tag;
use App\Support\Sanitizer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TagResource extends Resource
{
	protected static string|null $model = Tag::class;

	protected static string|null $navigationIcon = 'm-tag';

	protected static string|null $navigationGroup = 'Content';

	protected static int|null $navigationSort = 2;

	public static function form(Form $form): Form
	{
		return $form
			->schema([
				Forms\Components\TextInput::make('title')
					->required()
					->maxLength(180)
					->reactive()
					->live(500)
					->afterStateUpdated(static function (Forms\Get $get, Forms\Set $set, string|null $state) {
						$slug = str($get('slug'))->trim();

						if (!in_array($slug, [null, ''])) return;

						$set('slug', Sanitizer::slug($state)->toString());
					}),

				Forms\Components\TextInput::make('slug')
					->required()
					->unique(ignoreRecord: true)
					->maxLength(255)
					->alphaDash()
					->reactive()
					->live(500)
					->afterStateUpdated(static function (Forms\Get $get, Forms\Set $set, string|null $state) {
						$set('slug', Sanitizer::slug(match (trim($state)) {
							null, '' => $get('title'),
							default => $state
						})->toString());
					}),
			]);
	}

	#[\Override]
	public static function getNavigationBadge(): string|null
	{
		return self::getModel()::count();
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				Tables\Columns\TextColumn::make('title')
					->searchable(),
				Tables\Columns\TextColumn::make('slug')
					->searchable(),
				Tables\Columns\TextColumn::make('posts_count')
					->counts('posts')
					->label('Tagged Posts'),
				Tables\Columns\TextColumn::make('created_at')
					->dateTime()
					->sortable()
					->toggleable(isToggledHiddenByDefault: true),
				Tables\Columns\TextColumn::make('updated_at')
					->dateTime()
					->sortable()
					->toggleable(isToggledHiddenByDefault: true),
			])
			->filters([
				//
			])
			->actions([
				Tables\Actions\EditAction::make(),
			])
			->bulkActions([
				Tables\Actions\BulkActionGroup::make([
					Tables\Actions\DeleteBulkAction::make(),
				]),
			]);
	}

	public static function getRelations(): array
	{
		return [
			RelationManagers\PostsRelationManager::class,
		];
	}

	public static function getPages(): array
	{
		return [
			'index' => Pages\ListTags::route('/'),
			'create' => Pages\CreateTag::route('/create'),
			'edit' => Pages\EditTag::route('/{record}/edit'),
		];
	}
}
