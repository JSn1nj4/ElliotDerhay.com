<?php

namespace App\Filament\Resources\LoginActivities\Pages;

use App\Filament\Resources\LoginActivities\LoginActivityResource;
use Filament\Resources\Pages\ListRecords;

class ListLoginActivities extends ListRecords
{
	protected static string $resource = LoginActivityResource::class;

	protected function getHeaderActions(): array
	{
		return [];
	}
}
