@php /** @var App\Models\Project $project */ @endphp
@extends('admin.layouts.page')

@section('content')
	<x-row flex-class="md:flex flex-col gap-6">
		<x-column class="block w-full">
			@if($project->image)
				<img src="{{ $project->image->url }}" class="block rounded-lg" alt="">
			@endif

			<div class="flex flex-row pt-3 mt-2 gap-4">
				<p>Created {{ $project->created_at->toFormattedDateString() }}</p>
				@unless($project->created_at->unix() === $project->updated_at->unix())
					<p class="flex-grow-1">Last Updated {{ $project->updated_at->toFormattedDateString() }}</p>
				@endunless
			</div>

			<h1 class="content-title text-4xl pt-2 mt-1">{{ $project->name }}</h1>

			<div class="mb-4 mt-3">
				<x-ui.table.wrapper>
					<x-ui.table.body>
						<x-ui.table.row class="bg-sea-green-800/20 even:bg-sea-green-800/10">
							<x-ui.table.heading>Description:</x-ui.table.heading>
							<x-ui.table.data>{{ $project->short_desc }}</x-ui.table.data>
						</x-ui.table.row>
						<x-ui.table.row class="bg-sea-green-800/20 even:bg-sea-green-800/10">
							<x-ui.table.heading>Link:</x-ui.table.heading>
							<x-ui.table.data><a href="{{ $project->link }}">{{ $project->link }}</a></x-ui.table.data>
						</x-ui.table.row>
						<x-ui.table.row class="bg-sea-green-800/20 even:bg-sea-green-800/10">
							<x-ui.table.heading>Demo:</x-ui.table.heading>
							<x-ui.table.data><a href="{{ $project->demo_link }}">{{ $project->demo_link }}</a></x-ui.table.data>
						</x-ui.table.row>
					</x-ui.table.body>
				</x-ui.table.wrapper>
			</div>

			<div class="flex flex-row mt-6 gap-6 justify-end">
				@if($errors->any())
					<div class="block p-3 bg-red-200 dark:bg-red-900 border border-red-800 dark:border-red-100 text-red-800 dark:text-red-100 rounded flex-grow">
						<ul>
							@foreach($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@elseif(session()->has('success'))
					<div class="block p-3 bg-green-200 dark:bg-green-900 border border-green-900 dark:border-green-200 text-green-900 dark:text-green-200 rounded flex-grow">
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
