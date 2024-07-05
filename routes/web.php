<?php

use App\Http\Controllers\BlogPostsController;
use App\Http\Controllers\ProjectsPortfolioController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url as SitemapUrl;

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
	->group(static function () {
		Volt::route('/', 'blog-feed')->name('blog');
		Route::get('/{post:slug}', [BlogPostsController::class, 'show'])->name('blog.show');
	});

Route::get('/sitemap.xml',
	static fn (Request $request) => Cache::remember('sitemap',
		// cache for a week since the blog might update weekly
		ttl()->days(7)->get(),

		static fn (): Sitemap => Sitemap::create()
			->add(SitemapUrl::create(route('home'))
				->setLastModificationDate(Carbon::today())
				->setChangeFrequency(SitemapUrl::CHANGE_FREQUENCY_WEEKLY)
				->setPriority(0.1))
			->add(SitemapUrl::create(route('privacy'))
				->setLastModificationDate(Carbon::today())
				->setChangeFrequency(SitemapUrl::CHANGE_FREQUENCY_MONTHLY)
				->setPriority(0.1))
			->add(SitemapUrl::create(route('blog'))
				->setLastModificationDate(Carbon::today())
				->setChangeFrequency(SitemapUrl::CHANGE_FREQUENCY_WEEKLY)
				->setPriority(0.1))
			->add(\App\Models\Post::all())
	)
		->toResponse($request));
