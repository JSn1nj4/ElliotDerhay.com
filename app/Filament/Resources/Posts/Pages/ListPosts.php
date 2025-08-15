<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use App\Filament\Traits\HasCreateActionWithIcon;
use Filament\Resources\Pages\ListRecords;

class ListPosts extends ListRecords
{
	use HasCreateActionWithIcon;

    protected static string $resource = PostResource::class;
}
