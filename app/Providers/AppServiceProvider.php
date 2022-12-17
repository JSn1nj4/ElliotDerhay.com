<?php

namespace App\Providers;

use App\Actions\LogCommandEvent;
use App\Actions\LogUserLogin;
use App\Contracts\GitHostService;
use App\Contracts\SocialMediaService;
use App\Models\Token;
use App\Services\Github\GithubService;
use App\Services\Twitter\TwitterService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	public array $bindings = [
		LogCommandEvent::class => LogCommandEvent::class,
		LogUserLogin::class => LogUserLogin::class,
	];

	public array $singletons = [
		GitHostService::class => GithubService::class,
		SocialMediaService::class => TwitterService::class,
	];

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
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
	public function boot()
	{
		//
	}
}
