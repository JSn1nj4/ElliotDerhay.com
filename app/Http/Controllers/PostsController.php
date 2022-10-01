<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(Request $request)
	{
		return view('blog.index', [
			'posts' => Post::when(optional($request)->category, function ($query, $category_id): void {
					$query->whereRelation('categories', 'category_id', $category_id);
				})
				->when(optional($request)->tag, function ($query, $tag_id): void {
					$query->whereRelation('tags', 'tag_id', $tag_id);
				})
				->paginate(10)
				->withQueryString()
		]);
	}

	public function show(Request $request, Post $post)
	{
		return view('blog.post', compact('post'));
	}
}
