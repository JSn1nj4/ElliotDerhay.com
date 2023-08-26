<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommandResource\Pages;
use App\Filament\Resources\CommandResource\RelationManagers;
use App\Models\Command;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommandResource extends Resource
{
    protected static string|null $model = Command::class;

    protected static string|null $navigationIcon = 'm-command-line';

	protected static string|null $navigationGroup = 'Administration';

	protected static string|null $recordTitleAttribute = 'signature';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('signature')
                    ->required()
					->string()
                    ->maxLength(255)
					->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('description')
                    ->required()
					->string()
                    ->maxLength(255),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('signature')
					->searchable(),
                Tables\Columns\TextColumn::make('description')
					->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
				Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
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
            'index' => Pages\ListCommands::route('/'),
            'create' => Pages\CreateCommand::route('/create'),
            'view' => Pages\ViewCommand::route('/{record}'),
            'edit' => Pages\EditCommand::route('/{record}/edit'),
        ];
    }
}
