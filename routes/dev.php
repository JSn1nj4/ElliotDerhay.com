<?php

use App\Http\Controllers\PostsController;
// use App\Http\Controllers\ProjectsController;
use Illuminate\Support\Facades\Route;

// Route::get('/projects', [ProjectsController::class, 'index'])->name('projects');
Route::prefix('/blog')
	->group(function () {
		Route::get('/', [PostsController::class, 'index'])->name('blog');
		Route::get('/{post:slug}', [PostsController::class, 'show'])->name('blog.show');
	});

// error page testing route (only works locally)
Route::get('/error/{code}', function ($code = null) {
	if (!view()->exists("errors.$code")) abort(404);

	abort($code);
})->where('code', '[1-5][0-9]{2}');

Route::prefix('/dashboard')
	->middleware(['auth', 'verified'])
	->group(function() {
		Route::view('/', 'admin.dashboard');
		//	@todo post routes: resource? (index, create, store, show, edit, update, destroy)
		//	@todo project routes: resource? (index, create, store, show, edit, update, destroy)
	});

require __DIR__.'/auth.php';
