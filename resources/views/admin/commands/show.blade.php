@php
	/** @var App\Models\Command $command */
	/** @var App\Models\CommandEvent $event */
@endphp
@extends('admin.layouts.page')

@section('content')
	<x-row flex-class="md:flex flex-col gap-6">
		<x-column class="block w-full">

			<div class="mb-4 mt-3">
				<x-ui.table.wrapper>
					<x-ui.table.body>
						<x-ui.table.row class="bg-transparent">
							<x-ui.table.heading>Signature:</x-ui.table.heading>
							<x-ui.table.data>{{ $command->signature }}</x-ui.table.data>
						</x-ui.table.row>
						<x-ui.table.row class="bg-transparent">
							<x-ui.table.heading>Description:</x-ui.table.heading>
							<x-ui.table.data>{{ $command->description }}</x-ui.table.data>
						</x-ui.table.row>
					</x-ui.table.body>
				</x-ui.table.wrapper>
			</div>

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
							:href="route('commands.edit', compact('command'))"
							:link-style="\App\View\Components\Ui\Enums\LinkStyle::ButtonSolid"
						>
							Edit
						</x-ui.link>
						<x-ui.form.button
							title="Delete Command"
							color="red"
							font-size="text-2xl"
							width="w-full"
							form="delete_command"
							type="submit"
						>
							Delete
						</x-ui.form.button>
						<form
							id="delete_command"
							action="{{ route('commands.destroy', compact('command')) }}"
							method="POST"
							class="absolute -z-50 hidden"
						>
							@csrf
							@method('DELETE')
						</form>
					</div>
				</div>
			</div>

			<div class="px-6 py-6">
				<h2 class="text-2xl uppercase">Run Log</h2>
			</div>
			<x-ui.table.wrapper>
				<x-ui.table.header>
					<x-ui.table.row class="border-b border-gray-600">
						<x-ui.table.heading>Status</x-ui.table.heading>
						<x-ui.table.heading>Message</x-ui.table.heading>
						<x-ui.table.heading class="text-right">Date</x-ui.table.heading>
					</x-ui.table.row>
				</x-ui.table.header>
				<x-ui.table.body>
					@foreach($command->events()->limit(10)->get() as $event)
						<x-ui.table.row class="bg-sea-green-800/20 even:bg-sea-green-800/10">
							<x-ui.table.data>
								<i class="{{ implode(' ', array_keys(array_filter([
									'text-red-500 fas fa-times' => !$event->succeeded,
									'text-green-500 fas fa-check' => $event->succeeded,
								]))) }}"></i>
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
					<x-ui.table.row class="border-t border-gray-600">
						<x-ui.table.data colspan="4">
							<p>Last 10 Runs</p>
						</x-ui.table.data>
					</x-ui.table.row>
				</x-ui.table.footer>
			</x-ui.table.wrapper>

		</x-column>
	</x-row>
@endsection
