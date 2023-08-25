<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Pennant\Feature;

class FeatureServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
		// Force features on this site to be global by default
		Feature::resolveScopeUsing(static fn ($driver) => null);

        Feature::macro('toggle', static function (string $feature) {
			Feature::inactive($feature) ?
				Feature::activate($feature) :
				Feature::deactivate($feature);
		});
    }
}
