<?php

namespace App\Filament\Resources\CommandResource\Widgets;

use App\Models\Command;
use App\Models\CommandEvent;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class CommandLog extends TableWidget
{
	public Command|null $record = null;

	protected function getTablePollingInterval(): string|null
	{
		return '10s';
	}

	protected function getTableQuery(): Builder|Relation|null
	{
		return CommandEvent::whereHas(
			'command',
			fn (Builder $query) => $query->where(
				'signature',
				$this->record?->signature
			))
			->latest();
	}

	protected function getTableColumns(): array
	{
		return [
			IconColumn::make('succeeded')
				->label('Status')
				->boolean()
				->true('s-check', 'primary')
				->false('s-x-mark', 'danger'),
			TextColumn::make('command.signature')
				->label('Command'),
			TextColumn::make('message'),
			TextColumn::make('created_at')
				->dateTime()
				->label('Date'),
		];
	}
}
