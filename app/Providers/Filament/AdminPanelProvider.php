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
			->viteTheme('resources/css/filament/admin/theme.css')
			->id('admin')
			->path(config()->string('filament.admin.path'))
			->login(Login::class)
			->globalSearchKeyBindings(['command+k', 'ctrl+k'])
			->maxContentWidth('full')
			->colors([
				'primary' => [
					50 => '#effefb',
					100 => '#c8fff3',
					200 => '#91fee9',
					300 => '#47f5da',
					400 => '#1fe2c9',
					500 => '#06c6b1',
					600 => '#029f91',
					700 => '#067f75',
					800 => '#0b645f',
					900 => '#0e534e',
					950 => '#003331',
				],
				'info' => [
					50 => '#f4f7fb',
					100 => '#e9eef5',
					200 => '#cddcea',
					300 => '#a2bed7',
					400 => '#6f9cc1',
					500 => '#4d7faa',
					600 => '#3b668e',
					700 => '#305274',
					800 => '#2b4661',
					900 => '#283d52',
					950 => '#1e2c3d',
				],
			])
			->favicon(static fn () => asset_url("favicon-2026.png"))
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
