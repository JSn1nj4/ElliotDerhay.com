@php /** @var object|\App\Models\Post $fields */ @endphp
@extends('admin.layouts.page')

@section('content')
	<x-row flex-class="md:flex gap-6">
		<x-column class="block w-full">
			<form method="post" action="{{ $action }}">
				@csrf
				@yield('method')

				<div class="flex flex-col mb-6 gap-2">
					<label for="title" class="text-3xl">Post Title</label>
					<x-ui.form.input id="title" name="title" error="{{ $errors->has('title') }}" value="{{ $fields->title }}" text-size="text-2xl" padding="p-3" />
				</div>

				<div class="flex flex-col my-6 gap-2">
					<label for="slug" class="text-2xl">Slug</label>
					<x-ui.form.input id="slug" name="slug" error="{{ $errors->has('slug') }}" value="{{ $fields->slug }}" />
				</div>

				<div class="flex flex-col my-6 gap-2">
					<label for="body" class="text-2xl">Body</label>
					<x-ui.form.text-area id="body" name="body" error="{{ $errors->has('body') }}">
						{{ $fields->body }}
					</x-ui.form.text-area>
				</div>

				<div class="flex flex-row mt-6 gap-6 justify-end">
					@if($errors->any())
						<div class="block p-6 bg-red-900 border border-red-100 text-red-100 rounded flex-grow">
							<ul>
								@foreach($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
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
			</form>
		</x-column>
	</x-row>
@endsection
