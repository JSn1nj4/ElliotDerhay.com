<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
	->withRouting(
		web: __DIR__ . '/../routes/web.php',
		health: '/up',
		then: function (Application $app) {
			if ($app->environment(['production', 'staging'])) return;

			Route::prefix('dev')
				->middleware('web')
				->group(base_path('routes/dev.php'));
		},
	)
	->withMiddleware(static function (Middleware $middleware) {
		//
	})
	->withExceptions(static function (Exceptions $exceptions) {
		//
	})->create();
