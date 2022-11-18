<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BlogPostsController extends Controller
{
	public function index(Request $request): View
	{
		return view('blog.index', [
			'posts' => Post::index($request),
		]);
	}

	public function show(Post $post): View
	{
		return view('blog.post', compact('post'));
	}
}
