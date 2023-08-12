<?php

namespace App\Filament\Resources\ImageResource\Pages;

use App\Filament\Resources\ImageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditImage extends EditRecord
{
    protected static string $resource = ImageResource::class;

    protected function getActions(): array
    {
        return [
			Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
