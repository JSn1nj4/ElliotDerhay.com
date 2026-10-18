<?php

namespace App\Http\Controllers;

use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class PostPreviewController extends Controller
{
	public function show(string $previewRef): View
	{
		$user = Filament::auth()->user();

		abort_unless($user instanceof User, match (app()->isProduction()) {
			true => 404,
			default => 401,
		});

		return view('content-preview', [
			'content' => Cache::get($previewRef, ''),
		]);
	}
}
