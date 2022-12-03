@extends('admin.layouts.project-edit', [
    'action' => action([\App\Http\Controllers\ProjectsController::class, 'store']),
    'errors' => $errors,
    'fields' => (object) [
        'thumbnail' => old('thumbnail'),
        'name' => old('name'),
        'link' => old('link'),
        'demo_link' => old('demo_link'),
        'short_desc' => old('short_desc'),
		],
])

@section('buttons')
	<x-ui.form.button type="submit" width="w-full" font-size="text-2xl" form="save_project">Publish</x-ui.form.button>
@endsection
