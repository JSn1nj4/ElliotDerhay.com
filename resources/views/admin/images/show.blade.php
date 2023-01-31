@php /** @var App\Models\Image $image */ @endphp
@extends('admin.layouts.page')

@section('content')
	<x-row flex-class="md:flex flex-col gap-6">
		<x-column class="block w-full">
			<img src="{{ $image->url }}" class="block rounded-lg" alt="">

			<div class="flex flex-row pt-3 mt-2 gap-4">
				<p>Created {{ $image->created_at->toFormattedDateString() }}</p>
				@unless($image->created_at->unix() === $image->updated_at->unix())
					<p class="flex-grow-1">Last Updated {{ $image->updated_at->toFormattedDateString() }}</p>
				@endunless
			</div>

			<h1 class="content-title text-4xl pt-2 mt-1">{{ $image->name }}</h1>

			<div class="mb-4 mt-3">
				<x-ui.table.wrapper>
					<x-ui.table.body>
						<x-ui.table.row class="bg-sea-green-800/20 even:bg-sea-green-800/10">
							<x-ui.table.heading>Storage Location:</x-ui.table.heading>
							<x-ui.table.data>{{ $image->disk }}</x-ui.table.data>
						</x-ui.table.row>
						<x-ui.table.row class="bg-sea-green-800/20 even:bg-sea-green-800/10">
							<x-ui.table.heading>Size:</x-ui.table.heading>
							<x-ui.table.data>{{ $image->size }} bytes</a></x-ui.table.data>
						</x-ui.table.row>
					</x-ui.table.body>
				</x-ui.table.wrapper>
			</div>

			<div class="flex flex-row mt-6 gap-6 justify-end">
				@if(session()->has('error'))
					<div class="block p-3 bg-red-900 border border-red-100 text-red-100 rounded flex-grow">
						{{ session('error') }}
					</div>
				@elseif(session()->has('success'))
					<div class="block p-3 bg-green-900 border border-green-200 text-green-200 rounded flex-grow">
						{{ session('success') }}
					</div>
				@endif

				<div class="block">
					<div class="flex gap-2">
						<x-ui.form.button
							title="Delete Image"
							color="red"
							font-size="text-2xl"
							width="w-full"
							form="delete_image"
							type="submit"
						>
							Delete
						</x-ui.form.button>
						<form
							id="delete_image"
							action="{{ route('images.destroy', compact('image')) }}"
							method="POST"
							class="absolute -z-50 hidden"
						>
							@csrf
							@method('DELETE')
						</form>
					</div>
				</div>
			</div>
		</x-column>
	</x-row>
@endsection
