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
        Feature::macro('toggle', function (string $feature) {
			Feature::inactive($feature) ?
				Feature::activate($feature) :
				Feature::deactivate($feature);
		});

		/**
		 * @method void toggleForEveryone Warning: this will toggle the setting based on the current scope
		 */
		Feature::macro('toggleForEveryone', function (string $feature) {
			Feature::inactive($feature) ?
				Feature::activateForEveryone($feature) :
				Feature::deactivateForEveryone($feature);
		});
    }
}
