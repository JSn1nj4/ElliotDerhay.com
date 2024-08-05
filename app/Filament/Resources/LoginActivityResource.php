<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LoginActivityResource\Pages;
use App\Filament\Resources\LoginActivityResource\RelationManagers;
use App\Models\LoginActivity;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LoginActivityResource extends Resource
{
	protected static string|null $model = LoginActivity::class;

	protected static string|null $navigationGroup = 'Administration';

	protected static string|null $navigationIcon = 'm-clipboard-document-list';

	protected static string|null $navigationLabel = 'Login Activity';

	protected static int|null $navigationSort = 2;

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				TextColumn::make('created_at')
					->label('Time')
					->dateTime()
					->sortable(),

				TextColumn::make('email')
					->color(fn ($state) => match ($state) {
						Filament::auth()->user()->email => 'white',
						default => Color::Neutral,
					})
					->searchable(isIndividual: true, isGlobal: false),

				IconColumn::make('succeeded')
					->boolean(),

				TextColumn::make('info')
					->searchable(isIndividual: true, isGlobal: false),

				TextColumn::make('ip_address')
					->searchable(isIndividual: true, isGlobal: false)
					->fontFamily('mono'),
			])
			->filters([
				SelectFilter::make('succeeded')
					->options([
						true => 'Succeeded',
						false => 'Failed',
					]),
			])
			->actions([])
			->bulkActions([]);
	}

	public static function getRelations(): array
	{
		return [];
	}

	public static function getPages(): array
	{
		return [
			'index' => Pages\ListLoginActivities::route('/'),
		];
	}
}
