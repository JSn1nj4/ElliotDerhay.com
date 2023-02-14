<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ImageController extends Controller
{
	public function index(Request $request): View
	{
		return view('admin.images.index', [
			'images' => Image::index($request),
		]);
	}

	public function show(Image $image): View
	{
		return view('admin.images.show', compact('image'));
	}

	public function destroy(Image $image): Response|RedirectResponse
	{
		$image = $image->newQuery()
			->withCount(['posts', 'projects'])
			->find($image->id);

		if ($image->posts_count + $image->projects_count > 0) return back()
			->with('error', 'Image cannot be deleted. Detach it from items it is currently attached to first.');

		$image->delete();

		return redirect()
			->route('images.index')
			->with('success', 'Image deleted!');
	}
}
