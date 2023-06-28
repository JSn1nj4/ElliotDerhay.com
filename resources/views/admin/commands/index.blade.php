@php
	use App\View\Components\Ui\Enums\FormButtonShape;
	use App\View\Components\Ui\Enums\FormButtonStyle;
	use App\View\Components\Ui\Enums\LinkStyle;
	use Illuminate\Database\Eloquent\Collection;
	/**
	 * @var Collection $commands
	 * @var App\Models\Command $command
	 */
@endphp
@extends('admin.layouts.page')

@section('content')
	<x-row flex-class="null">
		<x-column class="block w-full">
			<div class="flex flex-col justify-between mb-8 gap-6">
				<h1 class="text-3xl uppercase">Commands</h1>
				@if(session()->has('success'))
					<div class="bg-green-900 border border-green-200 text-green-200 p-3 text-lg">{{ session('success') }}</div>
				@endif
			</div>
			<div class="px-6 pb-6">
				{{ $commands->links() }}
			</div>
			<x-ui.table.wrapper>
				<x-ui.table.header>
					<x-ui.table.row class="border-b border-neutral-600">
						<x-ui.table.heading>Signature</x-ui.table.heading>
						<x-ui.table.heading>Description</x-ui.table.heading>
						<x-ui.table.heading class="text-right">
							<x-ui.link
								:href="route('commands.create')"
								title="New Command"
								:link-style="LinkStyle::ButtonOutline"
							>
								<i class="fas fa-plus"></i>
							</x-ui.link>
						</x-ui.table.heading>
					</x-ui.table.row>
				</x-ui.table.header>
				<x-ui.table.body>
					@foreach($commands as $command)
						<x-ui.table.row class="bg-caribbeanGreen-800/20 even:bg-caribbeanGreen-800/10">
							<x-ui.table.data>
								<x-ui.link
									:href="route('commands.edit', compact('command'))"
									:link-style="LinkStyle::Plain"
								>
									{{ $command->signature }}
								</x-ui.link>
							</x-ui.table.data>
							<x-ui.table.data>
								{{ $command->description }}
							</x-ui.table.data>
							<x-ui.table.data class="text-right">
								<x-ui.link
									:href="route('commands.show', compact('command'))"
									title="View Command"
									:link-style="LinkStyle::ButtonOutline"
									color="yellow"
								>
									<i class="fas fa-search"></i>
								</x-ui.link>
								<x-ui.link
									:href="route('commands.edit', compact('command'))"
									title="Edit Command"
									:link-style="LinkStyle::ButtonOutline"
								>
									<i class="fas fa-pencil-alt"></i>
								</x-ui.link>
								<x-ui.form.button
									title="Delete Command"
									color="red"
									:button-style="FormButtonStyle::Outline"
									:shape="FormButtonShape::Square"
									form="delete_command-{{ $command->id }}"
									type="submit"
								>
									<i class="far fa-trash-alt"></i>
								</x-ui.form.button>
								<form
									id="delete_command-{{ $command->id }}"
									action="{{ route('commands.destroy', compact('command')) }}"
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
					<x-ui.table.row class="border-t border-neutral-600">
						<x-ui.table.data colspan="4">
							{{ $commands->links() }}
						</x-ui.table.data>
					</x-ui.table.row>
				</x-ui.table.footer>
			</x-ui.table.wrapper>
		</x-column>
	</x-row>
@endsection
