<?php

namespace App\Filament\Resources\CommandResource\Widgets;

use App\Models\Command;
use App\Models\CommandEvent;
use Filament\Tables;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class CommandLog extends TableWidget
{
	public Command|null $record = null;

	protected function getTableQuery(): Builder|Relation
	{
		return CommandEvent::whereHas(
			'command',
			fn (Builder $query) => $query->where(
				'signature',
				$this->record?->signature
			));
	}

	protected function getTableColumns(): array
	{
		return [
			Tables\Columns\IconColumn::make('succeeded')
				->label('Status')
				->boolean()
				->true('s-check', 'primary')
				->false('s-x-mark','danger'),
			Tables\Columns\TextColumn::make('command.signature')
				->label('Command'),
			Tables\Columns\TextColumn::make('command.description')
				->label('Description'),
			Tables\Columns\TextColumn::make('created_at')
				->label('Date')
				->dateTime(),
		];
	}
}
