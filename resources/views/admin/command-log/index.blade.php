@php
/**
 * @var \Illuminate\Database\Eloquent\Collection $events
 * @var App\Models\CommandEvent $event
 */
@endphp
@extends('admin.layouts.page')

@section('content')
	<x-row flex-class="null">
		<x-column class="block w-full">
			<div class="flex flex-col justify-between mb-8 gap-6">
				<h1 class="text-3xl uppercase">Command Event Log</h1>
				@if(session()->has('success'))
					<div class="bg-green-200 dark:bg-green-900 border border-green-900 dark:border-green-200 text-green-900 dark:text-green-200 p-3 text-lg">{{ session('success') }}</div>
				@endif
			</div>
			<div class="px-6 pb-6">
				{{ $events->links() }}
			</div>
			<x-ui.table.wrapper>
				<x-ui.table.header>
					<x-ui.table.row class="border-b border-neutral-600">
						<x-ui.table.heading>Status</x-ui.table.heading>
						<x-ui.table.heading>Command</x-ui.table.heading>
						<x-ui.table.heading>Message</x-ui.table.heading>
						<x-ui.table.heading class="text-right">Date</x-ui.table.heading>
					</x-ui.table.row>
				</x-ui.table.header>
				<x-ui.table.body>
					@foreach($events as $event)
						<x-ui.table.row class="bg-seaGreen-800/20 even:bg-seaGreen-800/10">
							<x-ui.table.data>
								<i class="{{ implode(' ', array_keys(array_filter([
									'text-red-500 fas fa-times' => !$event->succeeded,
									'text-green-500 fas fa-check' => $event->succeeded,
								]))) }}"></i>
							</x-ui.table.data>
							<x-ui.table.data>
								{{ $event->command->signature }}
							</x-ui.table.data>
							<x-ui.table.data>
								{{ $event->message }}
							</x-ui.table.data>
							<x-ui.table.data class="text-right">
								{{ $event->date_at_time }}
							</x-ui.table.data>
						</x-ui.table.row>
					@endforeach
				</x-ui.table.body>
				<x-ui.table.footer>
					<x-ui.table.row class="border-t border-neutral-600">
						<x-ui.table.data colspan="4">
							{{ $events->links() }}
						</x-ui.table.data>
					</x-ui.table.row>
				</x-ui.table.footer>
			</x-ui.table.wrapper>
		</x-column>
	</x-row>
@endsection
