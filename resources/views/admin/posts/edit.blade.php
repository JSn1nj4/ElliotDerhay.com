@php /** @var \App\Models\Post $post */ @endphp
@extends('admin.layouts.post-edit', [
    'action' => action([\App\Http\Controllers\PostsController::class, 'update'], compact('post')),
    'errors' => $errors,
    'fields' => (object) [
        'cover_image' => old('cover_image', $post->cover_image),
        'title' => old('title', $post->title),
        'slug' => old('slug', $post->slug),
        'body' => old('body', $post->body),
		],
])

@section('method')
	@method('PATCH')
@endsection

@section('buttons')
	<x-ui.form.button font-size="text-2xl" width="w-full" type="submit" form="save_post">Update</x-ui.form.button>
	<x-ui.form.button title="Delete Post" color="red" font-size="text-2xl" width="w-full" form="delete_post" type="submit">Delete</x-ui.form.button>
	<form id="delete_post" action="{{ route('posts.destroy', compact('post')) }}" method="POST" class="absolute -z-50 hidden">
		@csrf
		@method('DELETE')
	</form>
@endsection
