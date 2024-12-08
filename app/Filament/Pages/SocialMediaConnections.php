<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\MastodonConnectionWidget;
use Filament\Pages\Page;

class SocialMediaConnections extends Page
{
	protected static string|null $navigationIcon = 'heroicon-s-user-group';
	protected static string|null $navigationGroup = 'Administration';

	protected static int|null $navigationSort = 3;

	protected static string|null $slug = 'social-media';

	protected static string $view = 'filament.pages.social-media-connections';

	protected function getHeaderWidgets(): array
	{
		return [
			MastodonConnectionWidget::class,
		];
	}

	public function getHeaderWidgetsColumns(): int|string|array
	{
		return 3;
	}
}
