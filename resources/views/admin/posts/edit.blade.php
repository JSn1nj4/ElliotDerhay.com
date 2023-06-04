@php /** @var \App\Models\Post $post */ @endphp
@extends('admin.layouts.post-edit', [
    'action' => action([\App\Http\Controllers\PostsController::class, 'update'], compact('post')),
    'errors' => $errors,
    'image' => $post->image,
    'fields' => (object) [
        'cover_image' => old('cover_image'),
        'title' => old('title', $post->title),
        'search_title' => old('search_title', $post->searchMeta?->search_title),
        'search_description' => old('search_description', $post->searchMeta?->search_description),
        'slug' => old('slug', $post->slug),
        'body' => old('body', $post->body),
		],
		'post' => $post,
		'widgets' => (object) [
				'categories' => true,
				'tags' => old('tags', $post->tags),
		],
])

@section('method')
	@method('PATCH')
@endsection

@section('buttons')
	<x-ui.form.button
		font-size="text-2xl"
		width="w-full"
		type="submit"
		form="save_post"
	>
		Update
	</x-ui.form.button>
	<x-ui.link
		font-size="text-2xl"
		width="w-full"
		:href="route('posts.show', compact('post'))"
		:link-style="\App\View\Components\Ui\Enums\LinkStyle::ButtonSolid"
		color="yellow"
		title="View Post"
	>
		View
	</x-ui.link>
	<x-ui.form.button
		title="Delete Post"
		color="red"
		font-size="text-2xl"
		width="w-full"
		form="delete_post"
		type="submit"
	>
		Delete
	</x-ui.form.button>
	<form id="delete_post" action="{{ route('posts.destroy', compact('post')) }}" method="POST" class="absolute -z-50 hidden">
		@csrf
		@method('DELETE')
	</form>
@endsection
