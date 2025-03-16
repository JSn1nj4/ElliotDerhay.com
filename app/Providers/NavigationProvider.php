<?php

namespace App\Providers;

use App\DataTransferObjects\NavItemDTO;
use App\Enums\NavLocation;
use App\Features\BlogIndex;
use App\Features\ProjectsIndex;
use App\Navigation\Registry;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Laravel\Pennant\Feature;

class NavigationProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Registry::class, fn() => new Registry([
            NavLocation::AdminNavBar->name => collect([
                new NavItemDTO('home', 'Home', 'heroicon-m-home'),
            ])->when(Feature::active(BlogIndex::class), fn(Collection $collection) => $collection->push(
                new NavItemDTO('blog', 'Blog', 'heroicon-m-newspaper')
            ))->when(Feature::active(ProjectsIndex::class), fn(Collection $collection) => $collection->push(
                new NavItemDTO('portfolio', 'Projects', 'heroicon-m-code-bracket')
            )),

            NavLocation::PublicNavBar->name => collect([
                new NavItemDTO('home', 'Home', 'heroicon-m-home'),
            ])->when(Feature::active(BlogIndex::class), fn(Collection $collection) => $collection->push(
                new NavItemDTO('blog', 'Blog', 'heroicon-m-newspaper')
            ))->when(Feature::active(ProjectsIndex::class), fn(Collection $collection) => $collection->push(
                new NavItemDTO('portfolio', 'Projects', 'heroicon-m-code-bracket')
            ))
        ]));
    }

    public function boot(): void
    {
        //
    }
}
