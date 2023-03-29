@php /** @var \App\Models\Project $project */ @endphp
@extends('admin.layouts.project-edit', [
    'action' => action([\App\Http\Controllers\ProjectsController::class, 'update'], compact('project')),
    'errors' => $errors,
    'image' => $project->image,
    'fields' => (object) [
        'thumbnail' => old('thumbnail'),
        'name' => old('name', $project->name),
        'link' => old('link', $project->link),
        'demo_link' => old('demo_link', $project->demo_link),
        'short_desc' => old('short_desc', $project->short_desc),
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
		form="save_project"
	>
		Update
	</x-ui.form.button>
	<x-ui.link
		font-size="text-2xl"
		width="w-full"
		:href="route('projects.show', compact('project'))"
		:link-style="\App\View\Components\Ui\Enums\LinkStyle::ButtonSolid"
		color="yellow"
		title="View Project"
	>
		View
	</x-ui.link>
	<x-ui.form.button
		title="Delete Project"
		color="red"
		font-size="text-2xl"
		width="w-full"
		form="delete_project"
		type="submit"
	>
		Delete
	</x-ui.form.button>
	<form id="delete_project" action="{{ route('projects.destroy', compact('project')) }}" method="POST" class="absolute -z-50 hidden">
		@csrf
		@method('DELETE')
	</form>
@endsection
