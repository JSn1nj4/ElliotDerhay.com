@extends('admin.layouts.post-edit', [
    'action' => action([\App\Http\Controllers\PostsController::class, 'store']),
    'errors' => $errors,
    'fields' => (object) [
        'title' => old('title'),
        'slug' => old('slug'),
        'body' => old('body'),
		],
])

@section('buttons')
	<x-ui.form.button>Publish</x-ui.form.button>
@endsection
