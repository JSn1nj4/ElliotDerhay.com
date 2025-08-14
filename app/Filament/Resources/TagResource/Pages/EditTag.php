<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Resources\TagResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTag extends EditRecord
{
	protected static string $resource = TagResource::class;

	protected function getHeaderActions(): array
	{
		return [
			Actions\DeleteAction::make()
				->requiresConfirmation()
				->modalDescription('This will remove the tag from all tagged items. Are you sure you want to continue?')
				->databaseTransaction(),
		];
	}
}
