<?php

use App\Http\Controllers\BlogPostsController;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\CommandEventController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProjectsPortfolioController;
use App\Http\Controllers\RunCommandController;
use Illuminate\Support\Facades\Route;

Route::get('/projects', [ProjectsPortfolioController::class, 'index'])->name('portfolio');
Route::prefix('/blog')
	->group(function () {
		Route::get('/', [BlogPostsController::class, 'index'])->name('blog');
		Route::get('/{post:slug}', [BlogPostsController::class, 'show'])->name('blog.show');
	});

// error page testing route (only works locally)
Route::get('/error/{code}', function ($code = null) {
	if (!view()->exists("errors.$code")) abort(404);

	abort($code);
})->where('code', '[1-5][0-9]{2}');

Route::prefix('/dashboard')
	->middleware(['auth', 'verified'])
	->group(function() {
		Route::view('/', 'admin.dashboard')->name('dashboard');
		Route::resource('posts', PostsController::class);
		Route::resource('projects', ProjectsController::class);
		Route::resource('commands', CommandController::class);

		Route::get('command-log', [CommandEventController::class, 'index'])->name('command-events.index');

		Route::post('command-run', [RunCommandController::class, 'store'])->name('command-run.store');

		Route::post('upload', \App\Http\Controllers\UploadController::class)->name('upload');
	});

require __DIR__.'/auth.php';
