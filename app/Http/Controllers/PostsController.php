<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Jobs\StoreImageJob;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostsController extends Controller
{
    public function index(Request $request): View
	{
		return view('admin.posts.index', [
			'posts' => Post::index($request),
		]);
	}

	public function create(): View
	{
		return view('admin.posts.create');
	}

	public function store(StorePostRequest $request): Response|RedirectResponse
	{
		$post = Post::create($request->safe()->except('cover_image'));

		$this->dispatchSyncIf(
			$request->hasFile('cover_image'),
			new StoreImageJob($request->file('cover_image'), $post),
		);

		session()->flash('success', 'Post published!');

		return redirect()->route('posts.edit', compact('post'));
	}

	public function show(Post $post): View
	{
		return view('admin.posts.show', compact('post'));
	}

	public function edit(Post $post): View
	{
		return view('admin.posts.edit', compact('post'));
	}

	public function update(UpdatePostRequest $request, Post $post): Response|RedirectResponse
	{
		$post->update($request->safe()->except('cover_image'));

		$this->dispatchSyncIf(
			$request->hasFile('cover_image'),
			new StoreImageJob($request->file('cover_image'), $post),
		);

		return back()->with('success', 'Post updated!');
	}

	public function destroy(Post $post): Response|RedirectResponse
	{
		$post->delete();

		session()->flash('success', 'Post deleted!');

		return redirect()->route('posts.index');
	}
}
