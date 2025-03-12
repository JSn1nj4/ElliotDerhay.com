<?php

namespace App\Filament\Pages;

use App\Features\AdminLogin;
use App\Features\GithubFeed;
use App\Features\PublishPostToX;
use Filament\Forms;
use Filament\Pages\Page;
use Laravel\Pennant\Feature;

class Settings extends Page
{
	protected static string|null $navigationIcon = 'heroicon-o-cog';

	protected static string $view = 'filament.pages.settings';

	protected static string|null $navigationGroup = 'Administration';

	protected static string|null $navigationLabel = 'Settings';

	public array $features = [];

	public function form(Forms\Form $form): Forms\Form
	{
		return $form->statePath('features')->schema([
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

	public function __construct()
	{
		$this->features = [
			'admin_login' => Feature::active(AdminLogin::class),
			'github_feed' => Feature::active(GithubFeed::class),
			'publish_posts_to_x' => Feature::active(PublishPostToX::class),
		];
	}
}
