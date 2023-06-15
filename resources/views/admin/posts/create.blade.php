@extends('admin.layouts.post-edit', [
    'action' => action([\App\Http\Controllers\PostsController::class, 'store']),
    'errors' => $errors,
    'image' => null,
    'fields' => (object) [
        'cover_image' => old('cover_image'),
        'title' => old('title'),
        'search_title' => old('search_title'),
        'search_description' => old('search_description'),
        'slug' => old('slug'),
        'body' => old('body'),
		],
		'widgets' => (object) [
				'categories' => true,
				'tags' => old('tags'),
		],
])

@section('buttons')
	<x-ui.form.button type="submit" width="w-full" font-size="text-2xl" form="save_post">Publish</x-ui.form.button>
@endsection
