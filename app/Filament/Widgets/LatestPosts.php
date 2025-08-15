<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\Scopes\PostPublishedScope;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPosts extends BaseWidget
{
	protected int|string|array $columnSpan = 2;

	public function table(Table $table): Table
	{
		return $table
			->query(Post::latest('created_at')
				->withoutGlobalScope(PostPublishedScope::class)
				->limit(5))
			->paginated(false)
			->columns([
				TextColumn::make('title'),
				TextColumn::make('created_at')
					->dateTime('M d, Y | H:i')
					->label('Created'),
				TextColumn::make('published_at')
					->dateTime('M d, Y | H:i')
					->label('Published At'),
				IconColumn::make('published')
					->boolean()
					->true('s-check', 'primary')
					->false('s-x-mark', 'danger'),
			]);
	}
}
