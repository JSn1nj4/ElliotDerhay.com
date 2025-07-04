<?php

namespace App\Providers;

use App\Actions\AddCategoryToPost;
use App\Actions\AddTagToPost;
use App\Actions\HashPassword;
use App\Actions\LogCommandEvent;
use App\Contracts\GitHostService;
use App\DataTransferObjects\XApiCredentials;
use App\Services\Github\GithubService;
use App\Services\XService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	public array $bindings = [
		LogCommandEvent::class => LogCommandEvent::class,
	];

	public array $singletons = [
		AddCategoryToPost::class => AddCategoryToPost::class,
		AddTagToPost::class => AddTagToPost::class,
		GitHostService::class => GithubService::class,
		HashPassword::class => HashPassword::class,
	];

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register(): void
	{
		$this->app->singletonIf(
			XApiCredentials::class,
			static fn () => new XApiCredentials(
				account_id: config('services.x.account_id'),
				access_token: config('services.x.access_token'),
				access_token_secret: config('services.x.access_token_secret'),
				consumer_key: config('services.x.api_key'),
				consumer_secret: config('services.x.api_secret'),
				bearer_token: config('services.x.bearer_token'),
			),
		);

		$this->app->singletonIf(
			XService::class,
			static fn () => new XService(app(XApiCredentials::class)),
		);

		$this->app->singleton(
			\Faker\Generator::class . ':' . config('app.faker_locale'),
			static fn () => \App\Support\Faker\Factory::create(config('app.faker_locale')),
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
