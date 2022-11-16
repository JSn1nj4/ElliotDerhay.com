<?php

namespace App\Http\Controllers;

use App\Definitions\PostsPerPage;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
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

	public function store(StorePostRequest $request): Response|RedirectResponse
	{
		Post::create($request->validated());

		return back()->with('success', 'Post published!');
	}

	public function show(Post $post): View
	{
		return view('blog.post', compact('post'));
	}

	public function edit(Post $post): View
	{
		return view('admin.posts.edit', compact('post'));
	}

	public function update(UpdatePostRequest $request, Post $post): Response|RedirectResponse
	{
		$post->update($request->validated());

		return back()->with('success', 'Post updated!');
	}

	public function destroy(Post $post): Response|RedirectResponse
	{
		$post->delete();

		session()->flash('success', 'Post deleted!');

		return redirect()->route('posts.index');
	}
}
