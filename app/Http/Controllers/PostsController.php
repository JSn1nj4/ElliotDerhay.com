<?php

namespace App\Http\Controllers;

use App\Contracts\UploadServiceContract;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Image;
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
		if ($request->has('cover_image')) {
			$cover = Image::create(resolve(UploadServiceContract::class)
				->image($request->validated('cover_image'))
				->toArray());
		}

		$post = Post::create($request->safe()->except('cover_image'));

		if (isset($cover)) {
			$post->images()->attach($cover->id);
		}

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
		if ($request->has('cover_image')) {
			$cover = Image::create(resolve(UploadServiceContract::class)
				->image($request->validated('cover_image'))
				->toArray());
		}

		$post->update($request->safe()->except('cover_image'));

		if (isset($cover)) {
			$post->images()->attach($cover->id);
		}

		return back()->with('success', 'Post updated!');
	}

	public function destroy(Post $post): Response|RedirectResponse
	{
		$post->delete();

		session()->flash('success', 'Post deleted!');

		return redirect()->route('posts.index');
	}
}
