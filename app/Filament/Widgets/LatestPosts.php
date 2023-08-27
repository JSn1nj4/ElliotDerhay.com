<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Actions\DeleteAction;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;

class LatestPosts extends BaseWidget
{
	protected int | string | array $columnSpan = 2;

	public function table(Table $table): Table
    {
        return $table
            ->query(Post::latest('created_at')->limit(5))
			->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('title'),
				Tables\Columns\TextColumn::make('created_at')
					->dateTime('M d, Y | H:i')
					->label('Created'),
				Tables\Columns\TextColumn::make('published_at')
					->dateTime('M d, Y | H:i')
					->label('Published At'),
				Tables\Columns\IconColumn::make('published')
					->boolean()
					->true('s-check', 'primary')
					->false('s-x-mark','danger'),
            ]);
    }
}
