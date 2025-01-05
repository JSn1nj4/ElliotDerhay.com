<?php

namespace App\Providers;

use App\Actions\AddCategoryToPost;
use App\Actions\AddTagToPost;
use App\Actions\HashPassword;
use App\Actions\LogCommandEvent;
use App\Contracts\GitHostService;
use App\DataTransferObjects\MastodonApiCredentials;
use App\DataTransferObjects\MastodonAppInfo;
use App\DataTransferObjects\MastodonInstanceInfo;
use App\DataTransferObjects\XApiCredentials;
use App\Http\Clients\MastodonConnector;
use App\Models\Token;
use App\Services\Github\GithubService;
use App\Services\Twitter\TwitterService;
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

		$this->app->when(TwitterService::class)
			->needs(Token::class)
			->give(static fn () => Token::whereRaw("LOWER(service) LIKE '%twitter%'")
				->latest()
				->valid()
				->first());

		$this->app->singletonIf(
			XService::class,
			static fn () => new XService(app(XApiCredentials::class)),
		);

		$this->app->bind(MastodonInstanceInfo::class, fn () => new MastodonInstanceInfo(
			config('services.mastodon.instance.domain')
		));

		$this->app->bind(MastodonAppInfo::class, fn () => new MastodonAppInfo(
			config('services.mastodon.client.id'),
			config('services.mastodon.client.redirect_uris'),
			config('services.mastodon.client.scopes'),
			config('services.mastodon.client.website'),
		));

		$this->app->bind(MastodonApiCredentials::class, fn () => new MastodonApiCredentials(
			clientId: config('services.mastodon.client.id'),
			clientSecret: config('services.mastodon.client.secret'),
		));

		$this->app->singleton(
			MastodonConnector::class,
			static fn () => new MastodonConnector(
				instance: resolve(MastodonInstanceInfo::class),
				appInfo: resolve(MastodonAppInfo::class),
				credentials: resolve(MastodonApiCredentials::class),
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
