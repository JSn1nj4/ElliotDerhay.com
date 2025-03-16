<?php

use App\Features\BlogIndex;
use App\Features\ProjectsIndex;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Laravel\Pennant\Feature;
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
Volt::route('/', 'home')->name('home');

Volt::route('/privacy', 'privacy')->name('privacy');

Feature::when(ProjectsIndex::class, function () {
	Volt::route('/projects', 'projects.index')->name('portfolio');
});

Feature::when(BlogIndex::class, function () {
	Route::prefix('/blog')
		->group(static function () {
			Volt::route('/', 'blog.index')->name('blog');
			Volt::route('/{post:slug}', 'blog.post')->name('blog.show');
		});
});

Route::get('/sitemap.xml',
	static fn (Request $request) => Cache::remember('sitemap',
		// cache for a week since the blog might update weekly
		ttl()->days(1)->get(),

		static function (): Sitemap {
			$sitemap = Sitemap::create()
				->add(SitemapUrl::create(route('home'))
					->setLastModificationDate(Carbon::today())
					->setChangeFrequency(SitemapUrl::CHANGE_FREQUENCY_WEEKLY)
					->setPriority(0.1))
				->add(SitemapUrl::create(route('privacy'))
					->setLastModificationDate(Carbon::today())
					->setChangeFrequency(SitemapUrl::CHANGE_FREQUENCY_MONTHLY)
					->setPriority(0.1));

			if (Feature::active(BlogIndex::class)) {
				$sitemap->add(SitemapUrl::create(route('blog'))
					->setLastModificationDate(Carbon::today())
					->setChangeFrequency(SitemapUrl::CHANGE_FREQUENCY_WEEKLY)
					->setPriority(0.1))
					->add(\App\Models\Post::all());
			}

			if (Feature::active(ProjectsIndex::class)) {
				$sitemap->add(SitemapUrl::create(route('portfolio'))
					->setLastModificationDate(Carbon::today())
					->setChangeFrequency(SitemapUrl::CHANGE_FREQUENCY_MONTHLY)
					->setPriority(0.1));
			}

			return $sitemap;
		}
	)->toResponse($request));
