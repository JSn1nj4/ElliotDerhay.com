<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Filament\Traits\HasCreateActionWithIcon;
use Filament\Resources\Pages\ListRecords;

class ListPosts extends ListRecords
{
	use HasCreateActionWithIcon;

    protected static string $resource = PostResource::class;
}
