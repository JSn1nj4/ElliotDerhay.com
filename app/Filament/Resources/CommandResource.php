<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommandResource\Pages\CreateCommand;
use App\Filament\Resources\CommandResource\Pages\EditCommand;
use App\Filament\Resources\CommandResource\Pages\ListCommands;
use App\Filament\Resources\CommandResource\Pages\ViewCommand;
use App\Filament\Traits\HasCountBadge;
use App\Models\Command;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CommandResource extends Resource
{
	use HasCountBadge;

	protected static string|null $model = Command::class;

	protected static string|\BackedEnum|null $navigationIcon = 'm-command-line';

	protected static string|\UnitEnum|null $navigationGroup = 'Administration';

	protected static string|null $recordTitleAttribute = 'signature';

	public static function form(Schema $schema): Schema
	{
		return $schema
			->components([
				TextInput::make('signature')
					->required()
					->string()
					->maxLength(255)
					->unique(ignoreRecord: true),
				TextInput::make('description')
					->required()
					->string()
					->maxLength(255),
			]);
	}

	public static function table(Table $table): Table
	{
		return $table
			->columns([
				TextColumn::make('signature')
					->searchable(),
				TextColumn::make('description')
					->searchable(),
			])
			->filters([
				//
			])
			->recordActions([
				ViewAction::make(),
				EditAction::make(),
				DeleteAction::make(),
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
			'index' => ListCommands::route('/'),
			'create' => CreateCommand::route('/create'),
			'view' => ViewCommand::route('/{record}'),
			'edit' => EditCommand::route('/{record}/edit'),
		];
	}
}
