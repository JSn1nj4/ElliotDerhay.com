<?php

namespace App\Filament\Resources\LoginActivityResource\Pages;

use App\Filament\Resources\LoginActivityResource;
use Filament\Resources\Pages\ListRecords;

class ListLoginActivities extends ListRecords
{
	protected static string $resource = LoginActivityResource::class;

	protected function getHeaderActions(): array
	{
		return [];
	}
}
