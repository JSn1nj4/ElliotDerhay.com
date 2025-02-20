<?php

use Illuminate\Support\Facades\Route;

// error page testing route (only works locally)
Route::get('/error/{code}', function ($code = null) {
	if (!view()->exists("errors.$code")) abort(404);

	abort($code);
})->where('code', '[1-5][0-9]{2}');

Route::prefix('/preview')->group(static function () {
	Route::get('/mail/{name}', [\App\Http\Controllers\MailPreviewsController::class, 'show']);
});

Route::get('/phpinfo', static fn () => phpinfo());
