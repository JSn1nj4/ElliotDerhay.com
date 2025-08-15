<?php

namespace App\Filament\Resources\CommandEvents;

use App\Filament\Resources\CommandEvents\Pages\ListCommandEvents;
use App\Models\CommandEvent;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class CommandEventResource extends Resource
{
	protected static string|null $model = CommandEvent::class;

	protected static string|\BackedEnum|null $navigationIcon = 'm-clipboard-document-list';

	protected static string|null $navigationLabel = 'Command Log';

	protected static int|null $navigationSort = 1;

	protected static string|\UnitEnum|null $navigationGroup = 'Administration';

	public static function table(Table $table): Table
	{
		return $table
			->defaultSort('created_at', 'desc')
			->columns([
				IconColumn::make('succeeded')
					->boolean()
					->true('s-check', 'primary')
					->false('s-x-mark', 'danger')
					->label('Status'),
				TextColumn::make('command.signature')
					->searchable()
					->label('Command'),
				TextColumn::make('message')
					->searchable(),
				TextColumn::make('created_at')
					->dateTime()
					->sortable()
					->label('Date'),
			])
			->filters([
				TernaryFilter::make('succeeded')
					->trueLabel('Succeeded')
					->falseLabel('Failed')
					->label('Status'),
			])
			->toolbarActions([
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
			'index' => ListCommandEvents::route('/'),
		];
	}
}
