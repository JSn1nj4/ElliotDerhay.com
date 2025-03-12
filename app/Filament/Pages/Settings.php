<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Pages\Page;

class Settings extends Page
{
	protected static string|null $navigationIcon = 'heroicon-o-cog';

	protected static string $view = 'filament.pages.settings';

	protected static string|null $navigationGroup = 'Administration';

	protected static string|null $navigationLabel = 'Settings';

	public function form(Forms\Form $form): Forms\Form
	{
		return $form->schema([
			Forms\Components\Section::make('Features')
				->schema([
					Forms\Components\Toggle::make('admin_login')
						->label('Admin Login')
						->inlineLabel(),

					Forms\Components\Toggle::make('github_feed')
						->label('GitHub Activity Feed')
						->inlineLabel(),

					Forms\Components\Toggle::make('publish_posts_to_x')
						->label('Publish Posts to X')
						->inlineLabel(),
				])
		]);
	}
}
