<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ImageController extends Controller
{
	public function index(Request $request): View
	{
		return view('admin.images.index', [
			'images' => Image::index($request),
		]);
	}
}
