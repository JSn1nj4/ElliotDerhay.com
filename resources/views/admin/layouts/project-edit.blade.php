@php /** @var object|\App\Models\Project $fields */ @endphp
@extends('admin.layouts.page')

@section('content')
	<x-row flex-class="md:flex flex-col gap-6">
		<x-column class="block w-full">
			<form id="save_project" method="post" action="{{ $action }}">
				@csrf
				@yield('method')

				<div class="absolute hidden -z-50">
					<input type="hidden" value="-" name="thumbnail">
				</div>

				<x-admin.forms.field label="Project Title" field="name" :errors="$errors" large value="{{ $fields->name }}" />

				<x-admin.forms.field label="Link" field="link" :errors="$errors" value="{{ $fields->link }}" />

				<x-admin.forms.field label="Demo Link" field="demo_link" :errors="$errors" value="{{ $fields->demo_link }}" />

				<x-admin.forms.field label="Short Description" field="short_desc" :errors="$errors" value="{{ $fields->demo_link }}" multi-line />

			</form>
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
