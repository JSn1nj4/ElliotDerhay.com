<?php

namespace App\Filament\Resources\Tags\Pages;

use App\Filament\Resources\Tags\TagResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTag extends EditRecord
{
	protected static string $resource = TagResource::class;

	protected function getHeaderActions(): array
	{
		return [
			DeleteAction::make()
				->requiresConfirmation()
				->modalDescription('This will remove the tag from all tagged items. Are you sure you want to continue?')
				->databaseTransaction(),
		];
	}
}
