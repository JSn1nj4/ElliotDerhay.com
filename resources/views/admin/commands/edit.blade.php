@php /** @var \App\Models\Command $command */ @endphp
@extends('admin.layouts.command-edit', [
    'action' => action([\App\Http\Controllers\CommandController::class, 'update'], compact('command')),
    'errors' => $errors,
    'fields' => (object) [
        'signature' => old('signature', $command->signature),
        'description' => old('description', $command->description),
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
		form="save_command"
	>
		Update
	</x-ui.form.button>
	<x-ui.link
		font-size="text-2xl"
		width="w-full"
		:href="route('commands.show', compact('command'))"
		:link-style="\App\View\Components\Ui\Enums\LinkStyle::ButtonSolid"
		color="yellow"
		title="View Command"
	>
		View
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
	<form id="delete_command" action="{{ route('commands.destroy', compact('command')) }}" method="POST" class="absolute -z-50 hidden">
		@csrf
		@method('DELETE')
	</form>
@endsection
