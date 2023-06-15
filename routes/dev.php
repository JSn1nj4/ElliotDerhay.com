<?php

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

// error page testing route (only works locally)
Route::get('/error/{code}', function ($code = null) {
	if (!view()->exists("errors.$code")) abort(404);

	abort($code);
})->where('code', '[1-5][0-9]{2}');

Route::get('/sitemap.xml',
	static fn (Request $request) => Cache::remember('sitemap',
		10,
		static fn (): Sitemap => Sitemap::create()

			->add(Url::create(route('home'))
				->setLastModificationDate(Carbon::today())
				->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
				->setPriority(0.1))

			->add(Url::create(route('privacy'))
				->setLastModificationDate(Carbon::today())
				->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
				->setPriority(0.1))

			->add(Url::create(route('blog'))
				->setLastModificationDate(Carbon::today())
				->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
				->setPriority(0.1))

			->add(Post::all())
		)
		->toResponse($request));
