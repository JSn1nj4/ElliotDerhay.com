<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class SocialMediaConnections extends Page
{
	protected static string|null $navigationIcon = 'heroicon-s-user-group';
	protected static string|null $navigationGroup = 'Administration';

	protected static int|null $navigationSort = 3;

	protected static string $view = 'filament.pages.social-media-connections';
}
