@php /** @var App\Models\Project $project */ @endphp
@extends('admin.layouts.page')

@section('content')
	<x-row flex-class="md:flex flex-col gap-6">
		<x-column class="block w-full">
			<img src="{{ $project->thumbnail }}" class="block rounded-lg" alt="">

			<div class="flex flex-row pt-3 mt-2 gap-4">
				<p>Created {{ $project->created_at->toFormattedDateString() }}</p>
				@unless($project->created_at->unix() === $project->updated_at->unix())
					<p class="flex-grow-1">Last Updated {{ $project->updated_at->toFormattedDateString() }}</p>
				@endunless
			</div>

			<h1 class="content-title text-4xl pt-2 mt-1">{{ $project->name }}</h1>

			<x-markdown class="mb-4 mt-3">
				 {!! $project->short_desc !!}
			</x-markdown>

			<div class="flex flex-row mt-6 gap-6 justify-end">
				@if($errors->any())
					<div class="block p-3 bg-red-900 border border-red-100 text-red-100 rounded flex-grow">
						<ul>
							@foreach($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@elseif(session()->has('success'))
					<div class="block p-3 bg-green-900 border border-green-200 text-green-200 rounded flex-grow">
						{{ session('success') }}
					</div>
				@endif

				<div class="block">
					<div class="flex gap-2">
						<x-ui.link
							font-size="text-2xl"
							width="w-full"
							:href="route('projects.edit', compact('project'))"
							:link-style="\App\View\Components\Ui\Enums\LinkStyle::ButtonSolid"
						>
							Edit
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
						<form
							id="delete_project"
							action="{{ route('projects.destroy', compact('project')) }}"
							method="POST"
							class="absolute -z-50 hidden"
						>
							@csrf
							@method('DELETE')
						</form>
					</div>
				</div>
			</div>
		</x-column>
	</x-row>
@endsection
