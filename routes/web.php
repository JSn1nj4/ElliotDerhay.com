<?php

use App\Http\Controllers\BlogPostsController;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\CommandEventController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProjectsPortfolioController;
use App\Http\Controllers\RunCommandController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// standard views
Route::view('/', 'home')->name('home');

Route::view('/privacy', 'privacy')->name('privacy');

Route::get('/projects', [ProjectsPortfolioController::class, 'index'])->name('portfolio');
Route::prefix('/blog')
	->group(function () {
		Route::get('/', [BlogPostsController::class, 'index'])->name('blog');
		Route::get('/{post:slug}', [BlogPostsController::class, 'show'])->name('blog.show');
	});

Route::prefix('/dashboard')
	->middleware(['auth', 'verified'])
	->group(function() {
		Route::view('/', 'admin.dashboard')->name('dashboard');

		Route::resource('commands', CommandController::class);

		Route::get('command-log', [CommandEventController::class, 'index'])->name('command-events.index');

		Route::post('command-run', [RunCommandController::class, 'store'])->name('command-run.store');

		Route::resource('images', ImageController::class)->only(['index', 'show', 'destroy']);

		Route::resource('posts', PostsController::class);

		Route::resource('projects', ProjectsController::class);
	});

require __DIR__.'/auth.php';
