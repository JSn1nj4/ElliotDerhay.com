@php /** @var object|\App\Models\Post $fields */ @endphp
@extends('admin.layouts.page')

@section('content')
	<x-row flex-class="md:flex flex-col gap-6">
		<x-column class="block w-full">
			<form id="save_post" method="post" action="{{ $action }}">
				@csrf
				@yield('method')

				<div class="absolute hidden -z-50">
					<input type="hidden" value="-" name="cover_image">
				</div>

				<x-admin.forms.field label="Post Title" field="title" :errors="$errors" large value="{{ $fields->title }}" />

				<x-admin.forms.field label="Slug" field="slug" :errors="$errors" value="{{ $fields->slug }}" />

				<x-admin.forms.field label="Body" field="body" :errors="$errors" value="{{ $fields->body }}" multiline />

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
