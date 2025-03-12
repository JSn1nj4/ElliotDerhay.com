<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Settings extends Page
{
	protected static string|null $navigationIcon = 'heroicon-o-cog';

	protected static string $view = 'filament.pages.settings';

	protected static string|null $navigationGroup = 'Administration';

	protected static string|null $navigationLabel = 'Settings';
}
