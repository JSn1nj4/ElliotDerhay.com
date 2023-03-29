@extends('admin.layouts.post-edit', [
    'action' => action([\App\Http\Controllers\PostsController::class, 'store']),
    'errors' => $errors,
    'image' => null,
    'fields' => (object) [
        'cover_image' => old('cover_image'),
        'title' => old('title'),
        'slug' => old('slug'),
        'body' => old('body'),
		],
])

@section('buttons')
	<x-ui.form.button type="submit" width="w-full" font-size="text-2xl" form="save_post">Publish</x-ui.form.button>
@endsection
