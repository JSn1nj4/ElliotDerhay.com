<?php

namespace App\Filament\Pages;

use App\Features\AdminLogin;
use App\Features\BlogCategoriesWidget;
use App\Features\BlogGithubFeedWidget;
use App\Features\BlogIndex;
use App\Features\BlogTagsWidget;
use App\Features\GithubFeed;
use App\Features\ProjectsIndex;
use App\Features\PublishPostToX;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Laravel\Pennant\Feature;

class Settings extends Page
{
	protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog';

	protected string $view = 'filament.pages.settings';

	protected static string|\UnitEnum|null $navigationGroup = 'Administration';

	protected static string|null $navigationLabel = 'Settings';

	public array $features = [];

	public function form(Schema $schema): Schema
	{
		return $schema->statePath('features')->components([
			Section::make('General Features')
				->schema([
					Toggle::make('admin_login')
						->disabled()
						->helperText('This should always appear "on". You wouldn\'t want to lock yourself out, right?')
						->inlineLabel()
						->label('Admin Login'),

					Toggle::make('projects_index')
						->reactive()
						->afterStateUpdated(static function (bool $state) {
							match ($state) {
								true => Feature::activate(ProjectsIndex::class),
								false => feature::deactivate(ProjectsIndex::class),
							};

							Notification::make('projects_index_updated')
								->title('Projects Page feature updated!')
								->success()
								->send();
						})
						->inlineLabel()
						->label('Projects Page'),

					Toggle::make('github_feed')
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
						->inlineLabel()
						->label('GitHub Activity Feed'),

					Toggle::make('publish_posts_to_x')
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
						->inlineLabel()
						->label('Publish Posts to X'),
				]),

			Section::make('Blog Features')->schema([
				Toggle::make('blog_index')
					->reactive()
					->afterStateUpdated(static function (bool $state) {
						match ($state) {
							true => Feature::activate(BlogIndex::class),
							false => feature::deactivate(BlogIndex::class),
						};

						Notification::make('blog_index_updated')
							->title('Blog feature updated!')
							->success()
							->send();
					})
					->inlineLabel()
					->label('Blog index & individual pages'),

				Toggle::make('blog_categories_widget')
					->reactive()
					->afterStateUpdated(static function (bool $state) {
						match ($state) {
							true => Feature::activate(BlogCategoriesWidget::class),
							false => feature::deactivate(BlogCategoriesWidget::class),
						};

						Notification::make('blog_categories_widget_updated')
							->title('Blog Categories Widget feature updated!')
							->success()
							->send();
					})
					->inlineLabel()
					->label('Blog categories widget'),

				Toggle::make('blog_tags_widget')
					->reactive()
					->afterStateUpdated(static function (bool $state) {
						match ($state) {
							true => Feature::activate(BlogTagsWidget::class),
							false => feature::deactivate(BlogTagsWidget::class),
						};

						Notification::make('blog_tags_widget_updated')
							->title('Blog Tags Widget feature updated!')
							->success()
							->send();
					})
					->inlineLabel()
					->label('Blog tags widget'),

				Toggle::make('blog_github_feed_widget')
					->reactive()
					->afterStateUpdated(static function (bool $state) {
						match ($state) {
							true => Feature::activate(BlogGithubFeedWidget::class),
							false => feature::deactivate(BlogGithubFeedWidget::class),
						};

						Notification::make('blog_github_feed_widget_updated')
							->title('Blog GitHub Feed Widget feature updated!')
							->success()
							->send();
					})
					->inlineLabel()
					->label('Blog GitHub feed widget'),
			])
		]);
	}

	public function __construct()
	{
		$this->features = [
			'admin_login' => Feature::active(AdminLogin::class),
			'blog_index' => Feature::active(BlogIndex::class),
			'blog_categories_widget' => Feature::active(BlogCategoriesWidget::class),
			'blog_github_feed_widget' => Feature::active(BlogGithubFeedWidget::class),
			'blog_tags_widget' => Feature::active(BlogTagsWidget::class),
			'projects_index' => Feature::active(ProjectsIndex::class),
			'github_feed' => Feature::active(GithubFeed::class),
			'publish_posts_to_x' => Feature::active(PublishPostToX::class),
		];
	}
}
