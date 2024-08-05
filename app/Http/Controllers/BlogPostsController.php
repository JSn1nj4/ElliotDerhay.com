<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;

class BlogPostsController extends Controller
{
	public function show(Post $post): View
	{
		return view('blog.post', ['post' => $post->load('searchMeta')]);
	}
}
