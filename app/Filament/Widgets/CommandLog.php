<?php

namespace App\Filament\Widgets;

use App\Models\CommandEvent;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class CommandLog extends BaseWidget
{
	protected int|string|array $columnSpan = 2;

	public function table(Table $table): Table
	{
		return $table
			->query(CommandEvent::latest('created_at')->limit(5))
			->paginated(false)
			->columns([
				IconColumn::make('succeeded')
					->label('Status')
					->boolean()
					->true('s-check', 'primary')
					->false('s-x-mark', 'danger'),
				TextColumn::make('command.signature')
					->label('Command'),
				TextColumn::make('message'),
				TextColumn::make('created_at')
					->label('Date')
					->dateTime()
			]);
	}
}
