<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommandEventResource\Pages;
use App\Models\CommandEvent;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class CommandEventResource extends Resource
{
    protected static string|null $model = CommandEvent::class;

    protected static string|null $navigationIcon = 'm-clipboard-document-list';

	protected static string|null $navigationLabel = 'Command Log';

	protected static int|null $navigationSort = 1;

	protected static string|null $navigationGroup = 'Administration';

    public static function table(Tables\Table $table): Tables\Table
	{
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('succeeded')
					->boolean()
					->true('s-check', 'primary')
					->false('s-x-mark','danger')
					->label('Status'),
				Tables\Columns\TextColumn::make('command.signature')
					->searchable()
					->label('Command'),
				Tables\Columns\TextColumn::make('message'),
				Tables\Columns\TextColumn::make('created_at')
					->dateTime()
					->label('Date'),
            ])
            ->filters([
				Tables\Filters\TernaryFilter::make('succeeded')
					->trueLabel('Succeeded')
					->falseLabel('Failed')
					->label('Status'),
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
