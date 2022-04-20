<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(Request $request, int $page = 1)
	{
		$posts = Post::take(10)
			->offset(($page - 1) * 10)
			->get();

		return view('blog.index', compact('posts'));
	}

	public function show(Request $request, Post $post)
	{
		return view('blog.post', compact('post'));
	}
}
