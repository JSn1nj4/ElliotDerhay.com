<?php

namespace App\Http\Controllers;

use App\Definitions\PostsPerPage;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class PostsController extends Controller
{
    public function index(Request $request): View
	{
		$views = [
			'blog' => 'blog.index',
			'posts.index' => 'admin.posts.index',
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
				->latest()
				->paginate(PostsPerPage::filter(
					optional($request)->per_page
				))
				->withQueryString()
		]);
	}

	public function create(): View
	{
		return view('admin.posts.create');
	}

	public function store(Request $request): Response|RedirectResponse
	{
		Post::create([
			'cover_image' => '',
			'title' => $request->title,
			'slug' => $request->slug,
			'body' => $request->body,
		]);

		return redirect()->route('posts.index');
	}

	public function show(Post $post): View
	{
		return view('blog.post', compact('post'));
	}

	// public function edit(int $id): Response
	// {
	// 	// display 'edit' view to user
	// 	// might just be 'create' view, but pre-filled for existing item
	// }

	// public function update(Request $request, int $id): Response
	// {
	// 	// save changes to an existing item
	// }

	// public function destroy(int $id): Response
	// {
	// 	// delete an existing item
	// 	// maybe show a confirmation popup or page first, then
	// 	// redirect with an appropriate 'deleted' message
	//
	// 	// soft delete or no?
	// }
}
