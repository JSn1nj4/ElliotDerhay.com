<?php

namespace App\Filament\Resources\CommandResource\Pages;

use App\Filament\Resources\CommandResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCommand extends EditRecord
{
    protected static string $resource = CommandResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
