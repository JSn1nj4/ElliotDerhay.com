@php
use App\View\Components\Ui\Enums\LinkStyle;
/**
 * @var App\Models\Project[] $projects
 * @var App\Models\Project $project
 */
@endphp
@extends('admin.layouts.page')

@section('content')
	<x-row flex-class="null">
		<x-column class="block w-full">
			<div class="flex flex-col justify-between mb-8 gap-6">
				<h1 class="text-3xl uppercase">Projects</h1>
				@if(session()->has('success'))
					<div class="bg-green-200 dark:bg-green-900 border border-green-900 dark:border-green-200 text-green-900 dark:text-green-200 p-3 text-lg">{{ session('success') }}</div>
				@endif
			</div>
			<div class="px-6 pb-6">
				{{ $projects->links() }}
			</div>
			<x-ui.table.wrapper>
				<x-ui.table.header>
					<x-ui.table.row class="border-b border-gray-600">
						<x-ui.table.heading>Title</x-ui.table.heading>
						<x-ui.table.heading>Date</x-ui.table.heading>
						<x-ui.table.heading class="text-right">
							<x-ui.link
								href="{{ route('projects.create') }}"
								title="New Project"
								:link-style="LinkStyle::ButtonOutline">
								<i class="fas fa-plus"></i>
							</x-ui.link>
						</x-ui.table.heading>
					</x-ui.table.row>
				</x-ui.table.header>
				<x-ui.table.body>
					@foreach($projects as $project)
						<x-ui.table.row class="bg-sea-green-800/20 even:bg-sea-green-800/10">
							<x-ui.table.data>
								<x-ui.link
									href="{{ route('projects.edit', compact('project')) }}"
									:link-style="LinkStyle::Plain"
								>
									{{ $project->name }}
								</x-ui.link>
							</x-ui.table.data>
							<x-ui.table.data>
								{{ $project->created_at->format('M d Y \a\t H:i') }}
							</x-ui.table.data>
							<x-ui.table.data class="text-right">
								<x-ui.link
									:href="route('projects.show', compact('project'))"
									title="Preview Project"
									:link-style="LinkStyle::ButtonOutline"
									color="yellow"
								>
								  	<i class="fas fa-search"></i>
								</x-ui.link>
								<x-ui.link
									href="{{ route('projects.edit', compact('project')) }}"
									title="Edit Project"
									:link-style="LinkStyle::ButtonOutline"
								>
									<i class="fas fa-pencil-alt"></i>
								</x-ui.link>
								<x-ui.form.button
									title="Delete Project"
									color="red"
									:button-style="\App\View\Components\Ui\Enums\FormButtonStyle::Outline"
									:shape="\App\View\Components\Ui\Enums\FormButtonShape::Square"
									form="delete_project-{{ $project->id }}"
									type="submit"
								>
									<i class="far fa-trash-alt"></i>
								</x-ui.form.button>
								<form
									id="delete_project-{{ $project->id }}"
									action="{{ route('projects.destroy', compact('project')) }}"
									method="POST"
									class="absolute -z-50"
								>
									@csrf
									@method('DELETE')
								</form>
							</x-ui.table.data>
						</x-ui.table.row>
					@endforeach
				</x-ui.table.body>
				<x-ui.table.footer>
					<x-ui.table.row class="border-t border-gray-600">
						<x-ui.table.data colspan="3">
							{{ $projects->links() }}
						</x-ui.table.data>
					</x-ui.table.row>
				</x-ui.table.footer>
			</x-ui.table.wrapper>
		</x-column>
	</x-row>
@endsection
