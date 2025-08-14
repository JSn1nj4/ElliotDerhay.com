<?php

namespace App\Filament\Resources\TagResource\RelationManagers;

use App\Filament\Resources\PostResource;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class PostsRelationManager extends RelationManager
{
	protected static string $relationship = 'posts';

	public function form(Form $form): Form
	{
		return PostResource::form($form);
	}

	public function table(Table $table): Table
	{
		return PostResource::table($table);
	}
}
