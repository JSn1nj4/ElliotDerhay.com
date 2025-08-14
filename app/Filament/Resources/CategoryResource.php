<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
	protected static string|null $model = Category::class;

	protected static string|null $navigationIcon = 'heroicon-o-rectangle-stack';

	protected static string|null $navigationGroup = 'Content';

	protected static int|null $navigationSort = 2;

	public static function form(Form $form): Form
	{
		return $form
			->schema([
				Forms\Components\Textarea::make('title')
					->required()
					->columnSpanFull(),
				Forms\Components\TextInput::make('slug')
					->required()
					->maxLength(255),
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
				Tables\Columns\TextColumn::make('slug')
					->searchable(),
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
			//
		];
	}

	public static function getPages(): array
	{
		return [
			'index' => Pages\ListCategories::route('/'),
			'create' => Pages\CreateCategory::route('/create'),
			'edit' => Pages\EditCategory::route('/{record}/edit'),
		];
	}
}
