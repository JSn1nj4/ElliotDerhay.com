<?php

namespace App\Filament\Pages;

use App\Features\AdminLogin;
use App\Features\GithubFeed;
use App\Features\PublishPostToX;
use Filament\Forms;
use Filament\Notifications\Notification;
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
						->reactive()
						->afterStateUpdated(static function (bool $state) {
							match ($state) {
								true => Feature::activate(AdminLogin::class),
								false => feature::deactivate(AdminLogin::class),
							};

							Notification::make('admin_login_updated')
								->title('Admin Login feature updated!')
								->success()
								->send();
						})
						->label('Admin Login')
						->inlineLabel(),

					Forms\Components\Toggle::make('github_feed')
						->reactive()
						->afterStateUpdated(static function (bool $state) {
							match ($state) {
								true => Feature::activate(GithubFeed::class),
								false => feature::deactivate(GithubFeed::class),
							};

							Notification::make('github_feed_updated')
								->title('Github Feed feature updated!')
								->success()
								->send();
						})
						->label('GitHub Activity Feed')
						->inlineLabel(),

					Forms\Components\Toggle::make('publish_posts_to_x')
						->reactive()
						->afterStateUpdated(static function (bool $state) {
							match ($state) {
								true => Feature::activate(PublishPostToX::class),
								false => feature::deactivate(PublishPostToX::class),
							};

							Notification::make('publish_posts_to_x_updated')
								->title('Publish Posts to X feature updated!')
								->success()
								->send();
						})
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
