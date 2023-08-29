<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Filament\Traits\HasNewActionWithIcon;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPosts extends ListRecords
{
	use HasNewActionWithIcon;

    protected static string $resource = PostResource::class;
}
