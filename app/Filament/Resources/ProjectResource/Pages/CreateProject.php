<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
	use ProjectResource\Traits\PreparesForValidation;

    protected static string $resource = ProjectResource::class;
}
