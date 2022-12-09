<x-admin.widgets.wrapper>
	<x-slot:header>
		<x-admin.widgets.partials.title>
			Command Event Log
		</x-admin.widgets.partials.title>
		<x-admin.widgets.partials.button href="{{ route('command-events.index') }}">
			Manage
		</x-admin.widgets.partials.button>
	</x-slot:header>

	<table class="w-full mt-4">
		<thead>
			<th class="text-left mr-4 pb-2">Status</th>
			<th class="text-left mr-4 pb-2">Command</th>
			<th class="text-left mr-4 pb-2">Message</th>
			<th class="text-right pb-2">Date</th>
		</thead>
		<tbody>
			@foreach($events as $event)
				<tr>
					<td class="text-left mr-4 py-2">
						<i class="{{ implode(' ', array_keys(array_filter([
							'text-red-500 fas fa-times' => !$event->succeeded,
							'text-green-500 fas fa-check' => $event->succeeded,
						]))) }}"></i>
					</td>
					<td class="text-left mr-4 py-2">
						{{ $event->command->signature }}
					</td>
					<td class="text-left mr-4 py-2">
						{{ $event->message }}
					</td>
					<td class="text-right py-2">
						{{ $event->shortDate }}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</x-admin.widgets.wrapper>
