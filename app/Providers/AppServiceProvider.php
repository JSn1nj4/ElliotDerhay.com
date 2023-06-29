<?php

namespace App\Providers;

use App\Actions\AddCategoryToPost;
use App\Actions\AddTagToPost;
use App\Actions\HashPassword;
use App\Actions\LogCommandEvent;
use App\Actions\LogUserLogin;
use App\Contracts\GitHostService;
use App\Contracts\SocialMediaService;
use App\Filament\Resources\CommandEventResource;
use App\Filament\Resources\CommandResource;
use App\Models\Token;
use App\Services\Github\GithubService;
use App\Services\Twitter\TwitterService;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	public array $bindings = [
		LogCommandEvent::class => LogCommandEvent::class,
		LogUserLogin::class => LogUserLogin::class,
	];

	public array $singletons = [
		AddCategoryToPost::class => AddCategoryToPost::class,
		AddTagToPost::class => AddTagToPost::class,
		GitHostService::class => GithubService::class,
		SocialMediaService::class => TwitterService::class,
		HashPassword::class => HashPassword::class,
	];

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register(): void
	{
		$this->app->when(TwitterService::class)
			->needs(Token::class)
			->give(fn () => Token::whereRaw("LOWER(service) LIKE '%twitter%'")
				->latest()
				->valid()
				->first());
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		Filament::serving(static function () {
			Filament::registerViteTheme('resources/css/filament.css');

			Filament::registerNavigationGroups([
				NavigationGroup::make('Content'),
				NavigationGroup::make('Administration'),
			]);
		});
	}
}
