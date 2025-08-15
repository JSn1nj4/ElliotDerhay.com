<?php

namespace App\Filament\Resources\Categories\RelationManagers;

use App\Filament\Resources\Posts\PostResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class PostsRelationManager extends RelationManager
{
	protected static string $relationship = 'posts';

	public function form(Schema $schema): Schema
	{
		return PostResource::form($schema);
	}

	public function table(Table $table): Table
	{
		return PostResource::table($table);
	}
}
