<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
	protected static string $resource = CategoryResource::class;

	protected function getHeaderActions(): array
	{
		return [
			Actions\DeleteAction::make()
				->requiresConfirmation()
				->modalDescription('This will remove the category from all attached items. Are you sure you want to continue?')
				->databaseTransaction(),
		];
	}
}
