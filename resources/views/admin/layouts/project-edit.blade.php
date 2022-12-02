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

				<div class="flex flex-col mb-6 gap-2">
					<label for="title" class="text-3xl">Project Title</label>
					<x-ui.form.input id="title" name="name" error="{{ $errors->has('name') }}" value="{{ $fields->name }}" text-size="text-2xl" padding="p-3" />
				</div>

				<div class="flex flex-col my-6 gap-2">
					<label for="link" class="text-2xl">Link</label>
					<x-ui.form.input id="link" name="link" error="{{ $errors->has('link') }}" value="{{ $fields->link }}" />
				</div>

				<div class="flex flex-col my-6 gap-2">
					<label for="demo_link" class="text-2xl">Demo Link</label>
					<x-ui.form.input id="demo_link" name="demo_link" error="{{ $errors->has('demo_link') }}" value="{{ $fields->demo_link }}" />
				</div>

				<div class="flex flex-col my-6 gap-2">
					<label for="short_desc" class="text-2xl">Short Description</label>
					<x-ui.form.text-area id="short_desc" name="short_desc" error="{{ $errors->has('short_desc') }}">
						{{ $fields->short_desc }}
					</x-ui.form.text-area>
				</div>

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
