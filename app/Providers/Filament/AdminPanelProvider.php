<?php

namespace App\Providers\Filament;

use App\Enums\NavLocation;
use App\Filament\Pages\Login;
use App\Filament\Widgets\CommandLog;
use App\Filament\Widgets\LastLoginWidget;
use App\Filament\Widgets\LatestPosts;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
	public function panel(Panel $panel): Panel
	{
		return $panel
			->default()
			->id('admin')
			->path(config()->string('filament.admin.path'))
			->login(Login::class)
			->globalSearchKeyBindings(['command+k', 'ctrl+k'])
			->maxContentWidth('full')
			->colors([
				'primary' => [
					50 => '#eafff7',
					100 => '#cdfeeb',
					200 => '#a0fadc',
					300 => '#63f2ca',
					400 => '#25e2b3',
					500 => '#00c49a',
					600 => '#00a481',
					700 => '#00836b',
					800 => '#006756',
					900 => '#005548',
					950 => '#00302a',
				],
				'danger' => Color::Rose,
			])
			->favicon(static fn () => asset_url("avatar.png"))
			->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
			->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
			->navigationGroups([
				NavigationGroup::make('Frontend')->collapsed(),
				NavigationGroup::make('Content'),
				NavigationGroup::make('Administration'),
			])
			->pages([
				Dashboard::class,
			])
			->widgets([
				LastLoginWidget::class,
				LatestPosts::class,
				CommandLog::class,
			])
			->middleware([
				EncryptCookies::class,
				AddQueuedCookiesToResponse::class,
				StartSession::class,
				AuthenticateSession::class,
				ShareErrorsFromSession::class,
				VerifyCsrfToken::class,
				SubstituteBindings::class,
				DisableBladeIconComponents::class,
				DispatchServingFilamentEvent::class,
			])
			->authMiddleware([
				Authenticate::class,
			])
			->bootUsing(function (Panel $panel) {
				$panel->navigationItems(nav(NavLocation::AdminNavBar)
					->map->navigationItem()
					->each->group('Frontend')
					->each->openUrlInNewTab()
					->all());
			});
	}
}
