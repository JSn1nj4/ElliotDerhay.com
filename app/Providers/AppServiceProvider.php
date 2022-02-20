<?php

namespace App\Providers;

use App\Contracts\GitHostService;
use App\Contracts\SocialMediaService;
use App\Services\Github\GithubService;
use App\Services\Twitter\TwitterService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton(GitHostService::class, fn($app) => new GithubService);

		$this->app->singleton(SocialMediaService::class, fn($app) => new TwitterService);
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
