@php /** @var object|\App\Models\Command $fields */ @endphp
@extends('admin.layouts.page')

@section('content')
	<x-row flex-class="md:flex flex-col gap-6">
		<x-column class="block w-full">
			<form id="save_command" method="post" action="{{ $action }}">
				@csrf
				@yield('method')

				<x-admin.forms.field label="Command Signature" field="signature" :errors="$errors" large value="{{ $fields->signature }}" />

				<x-admin.forms.field label="Description" field="description" :errors="$errors" multiline value="{{ $fields->description }}" />

			</form>
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
				@hasSection('buttons')
					<div class="block">
						<div class="flex gap-2">
							@yield('buttons')
						</div>
					</div>
				@endif
			</div>
		</x-column>
	</x-row>
@endsection
