@php /** @var object|\App\Models\Post $fields */ @endphp
@extends('admin.layouts.page')

@pushonce('head-extras')
	@livewireStyles
@endpushonce

@section('content')
	<x-row flex-class="md:flex gap-6">
		<x-column class="block w-2/3">
			<form id="save_post" method="post" action="{{ $action }}" enctype="multipart/form-data">
				@csrf
				@yield('method')

				<div class="flex flex-col gap-2 w-full mb-6">
					<p><label for="cover_image" class="text-3xl">Cover Image</label></p>
					@if($image) <p><img src="{{ $image->url }}" class="w-full"></p> @endif
					<p><input type="file" id="cover_image" name="cover_image" value="{!! $fields->cover_image !!}"></p>
				</div>

				<x-admin.forms.field label="Post Title" field="title" :errors="$errors" large :value="$fields->title ?? ''" />

				<x-admin.forms.field label="Custom Search Title" field="search_title" :errors="$errors" :value="$fields->search_title ?? ''" />

				<x-admin.forms.field label="Custom Search Description" field="search_description"
														 :errors="$errors" :value="$fields->search_description ?? ''"
														 multiline :multiline-size="\App\Enums\TextAreaHeight::Small" />

				<x-admin.forms.field label="Slug" field="slug" :errors="$errors" :value="$fields->slug ?? ''" />

				<x-admin.forms.field label="Body" field="body" :errors="$errors" :value="$fields->body ?? ''"
														 multiline :multiline-size="\App\Enums\TextAreaHeight::Large" />

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
			</div>
		</x-column>

		<x-column class="block w-1/3">
			<div class="flex flex-row gap-8 mb-6">
				<div class="flex flex-col gap-4 flex-grow">
					@hasSection('buttons')
						<div class="flex flex-col w-full gap-2 rounded-lg border dark:border-gray-600 dark:bg-gray-600/20 p-4">
							<p class="text-3xl">Actions</p>
							<div class="flex gap-4 just">
								@yield('buttons')
							</div>
						</div>
					@endif

					@if($widgets?->tags !== null)
						<x-admin.editing.widgets.tags form="save_post" :errors="$errors->tags" :tags="$widgets->tags ?? ''" />
					@endif
				</div>
			</div>
		</x-column>
	</x-row>
@endsection

@pushonce('footer-extras')
	@livewireScripts
@endpushonce
