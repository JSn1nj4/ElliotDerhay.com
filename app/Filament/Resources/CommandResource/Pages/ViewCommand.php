<?php

namespace App\Filament\Resources\CommandResource\Pages;

use App\Filament\Resources\CommandResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCommand extends ViewRecord
{
    protected static string $resource = CommandResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

	protected function getFooterWidgets(): array
	{
		return [
			CommandResource\Widgets\CommandLog::class,
		];
	}

	protected function getFooterWidgetsColumns(): int|string|array
	{
		return [
			'md' => 1,
		];
	}
}
