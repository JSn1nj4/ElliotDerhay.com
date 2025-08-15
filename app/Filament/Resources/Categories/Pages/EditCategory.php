<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
	protected static string $resource = CategoryResource::class;

	protected function getHeaderActions(): array
	{
		return [
			DeleteAction::make()
				->requiresConfirmation()
				->modalDescription('This will remove the category from all attached items. Are you sure you want to continue?')
				->databaseTransaction(),
		];
	}
}
