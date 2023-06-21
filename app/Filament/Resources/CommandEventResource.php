<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommandEventResource\Pages;
use App\Models\CommandEvent;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class CommandEventResource extends Resource
{
    protected static ?string $model = CommandEvent::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('status')
					->options([
						'heroicon-s-x',
						'heroicon-s-check' => static fn ($state, CommandEvent $record) => $record->succeeded,
					])
					->colors([
						'danger',
						'primary' => static fn ($state, CommandEvent $record) => $record->succeeded,
					]),
				Tables\Columns\TextColumn::make('command.signature')
					->label('Command'),
				Tables\Columns\TextColumn::make('message'),
				Tables\Columns\TextColumn::make('created_at')
					->label('Date')
					->dateTime(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListCommandEvents::route('/'),
        ];
    }
}
