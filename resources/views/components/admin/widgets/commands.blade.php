<x-admin.widgets.wrapper>
	<x-slot:header>
		<x-admin.widgets.partials.title>
			Admin Commands
		</x-admin.widgets.partials.title>
		<x-admin.widgets.partials.button href="{{ route('commands.index') }}">
			Manage
		</x-admin.widgets.partials.button>
	</x-slot:header>

	<table class="w-full mt-4">
		<thead>
			<th class="text-left mr-4 pb-2">
				Signature
			</th>
			<th class="text-right pb-2">
				Last Run
			</th>
		</thead>
		<tbody>
			@foreach($commands as $command)
				<tr>
					<td class="text-left mr-4 py-2">
						{{ $command->signature }}
					</td>
					<td class="text-right py-2">
						{{ $command->events()->latest()->first()->short_date }}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</x-admin.widgets.wrapper>
