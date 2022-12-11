@extends('admin.layouts.command-edit', [
    'action' => action([\App\Http\Controllers\CommandController::class, 'store']),
    'errors' => $errors,
    'fields' => (object) [
        'signature' => old('signature'),
        'description' => old('description'),
		],
])

@section('buttons')
	<x-ui.form.button type="submit" width="w-full" font-size="text-2xl" form="save_command">Publish</x-ui.form.button>
@endsection
