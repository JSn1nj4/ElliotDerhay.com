<?php

namespace App\Http\Controllers;

use App\Definitions\PostsPerPage;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PostsController extends Controller
{
    public function index(Request $request)
	{
		$views = [
			'blog' => 'blog.index',
			'dashboard.posts' => 'admin.dashboard.posts',
		];

		if(!Arr::exists($views, $request->route()->getName())) {
			abort(404);
		}

		return view($views[$request->route()->getName()], [
			'posts' => Post::when(optional($request)->category, function ($query, $category_id): void {
					$query->whereRelation('categories', 'category_id', $category_id);
				})
				->when(optional($request)->tag, function ($query, $tag_id): void {
					$query->whereRelation('tags', 'tag_id', $tag_id);
				})
				->paginate(PostsPerPage::filter(
					optional($request)->per_page
				))
				->withQueryString()
		]);
	}

	public function show(Request $request, Post $post)
	{
		return view('blog.post', compact('post'));
	}
}
