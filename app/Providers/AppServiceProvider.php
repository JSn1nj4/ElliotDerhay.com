<?php

namespace App\Providers;

use App\Actions\AddCategoryToPost;
use App\Actions\AddTagToPost;
use App\Actions\HashPassword;
use App\Actions\LogCommandEvent;
use App\Actions\LogUserLogin;
use App\Contracts\GitHostService;
use App\Contracts\SocialMediaService;
use App\DataTransferObjects\TokenDTO;
use App\Models\Token;
use App\Services\Github\GithubService;
use App\Services\Twitter\TwitterService;
use App\Services\X\XService;
use Illuminate\Support\Facades\URL;
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
		TwitterService::class => TwitterService::class,
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
			->give(static fn () => Token::whereRaw("LOWER(service) LIKE '%twitter%'")
				->latest()
				->valid()
				->first());

		$this->app->singletonIf(
			SocialMediaService::class,
			static fn () => new XService(
				new TokenDTO(config('services.x.token'))
			),
		);
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		if (app()->isProduction()) URL::forceScheme('https');
	}
}
