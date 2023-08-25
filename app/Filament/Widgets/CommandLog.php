<?php

namespace App\Filament\Widgets;

use App\Models\CommandEvent;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class CommandLog extends BaseWidget
{
	protected int | string | array $columnSpan = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(CommandEvent::latest('created_at')->limit(5))
			->paginated(false)
            ->columns([
				Tables\Columns\IconColumn::make('succeeded')
					->label('Status')
					->boolean()
					->true('s-check', 'primary')
					->false('s-x-mark','danger'),
				Tables\Columns\TextColumn::make('command.signature')
					->label('Command'),
				Tables\Columns\TextColumn::make('message'),
				Tables\Columns\TextColumn::make('created_at')
					->label('Date')
					->dateTime()
            ]);
    }
}
