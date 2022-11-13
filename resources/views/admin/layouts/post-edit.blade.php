@php /** @var $fields[body,slug,title] */ @endphp
@extends('admin.layouts.page')

@section('content')
	<x-row flex-class="md:flex gap-6">
		<x-column class="block w-full">
			<form method="post" action="{{ $action }}">
				@csrf
				@if($editing) @method('PATCH') @endif
				<div class="flex flex-col mb-6 gap-2">
					<label for="title" class="text-3xl">Post Title</label>
					<input id="title" name="title" type="text" class="text-2xl p-3 dark:bg-gray-800 outline outline-1 outline-gray-700 focus:outline-gray-600 transition-colors dark:transition-colors duration-300 rounded @error('title') outline-red-200 focus:outline-red-100 dark:bg-red-900 @enderror" value="{{ $fields->title }}">
				</div>

				<div class="flex flex-col my-6 gap-2">
					<label for="slug" class="text-2xl">Slug</label>
					<input type="text" id="slug" name="slug" class="text-lg p-2 dark:bg-gray-800 outline outline-1 outline-gray-700 focus:outline-gray-600 transition-colors dark:transition-colors duration-300 rounded @error('slug')) outline-red-200 focus:outline-red-100 dark:bg-red-900 @enderror" value="{{ $fields->slug }}">
				</div>

				<div class="flex flex-col my-6 gap-2">
					<label for="body" class="text-2xl">Body</label>
					<textarea name="body" id="body" class="w-full text-lg p-2 dark:bg-gray-800 outline outline-1 outline-gray-700 focus:outline-gray-600 transition-colors dark:transition-colors duration-300 rounded h-64 @error('body')) outline-red-200 focus:outline-red-100 dark:bg-red-900 @enderror">{{ $fields->body }}</textarea>
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
					<div>
						<button type="submit" class="w-full bg-sea-green-600 hover:bg-gray-700/50 transition-colors dark:transition-colors duration-300 rounded px-3 py-1 text-2xl dark:text-black dark:hover:text-white">{{ $editing ? 'Update' : 'Publish' }}</button>
					</div>
				</div>
			</form>
		</x-column>
	</x-row>
@endsection
