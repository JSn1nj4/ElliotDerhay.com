<x-admin.widgets.wrapper>
	<x-slot:header>
		<x-admin.widgets.partials.title>
			Projects
		</x-admin.widgets.partials.title>
		<x-admin.widgets.partials.button :href="route('projects.index')">
			Manage
		</x-admin.widgets.partials.button>
	</x-slot:header>

	<table class="w-full mt-4">
		<thead>
			<tr>
				<th class="text-left pb-2">Title</th>
			</tr>
		</thead>
		<tbody>
			@foreach($projects as $project)
				<tr>
					<td class="text-left py-2">{{ $project->name }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</x-admin.widgets.wrapper>
