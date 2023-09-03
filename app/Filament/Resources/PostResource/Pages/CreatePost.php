<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Filament\Traits\HasCreateFormActionsWithIcons;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
	use PostResource\Traits\PreparesForValidation,
		HasCreateFormActionsWithIcons;

    protected static string $resource = PostResource::class;
}
