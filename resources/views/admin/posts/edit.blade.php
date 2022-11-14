@php /** @var \App\Models\Post $post */ @endphp
@extends('admin.layouts.post-edit', [
    'action' => action([\App\Http\Controllers\PostsController::class, 'update'], compact('post')),
    'errors' => $errors,
    'fields' => (object) [
        'title' => old('title') ?? $post->title,
        'slug' => old('slug') ?? $post->slug,
        'body' => old('body') ?? $post->body,
		],
])

@section('method')
	@method('PATCH')
@endsection

@section('buttons')
	<x-ui.form.button>Update</x-ui.form.button>
	<x-ui.link href="#" title="Delete Post" :style="\App\View\Components\Ui\Enums\LinkStyle::ButtonSolid" color="red">Delete</x-ui.link>
@endsection
