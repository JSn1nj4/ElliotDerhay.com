@php
use App\View\Components\Ui\Enums\LinkStyle
/**
 * @var App\Models\Image[] $images
 * @var App\Models\Image $image
 */
@endphp
@extends('admin.layouts.page')

@section('content')
	<x-row flex-class="null">
		<x-column class="block w-full">
			<div class="flex flex-col justify-between mb-8 gap-6">
				<h1 class="text-3xl uppercase">Media Manager</h1>
				@if(session()->has('success'))
					<div class="bg-green-200 dark:bg-green-900 border border-green-900 dark:border-green-200 text-green-900 dark:text-green-200 p-3 text-lg">{{ session('success') }}</div>
				@endif
			</div>
			<div class="px-6 pb-6">
				{{ $images->links() }}
			</div>
		</x-column>
	</x-row>
	@foreach($images->chunk(5) as $chunk)
		<x-row>
			@foreach($chunk as $image)
				<x-column class="w-1/5">
					<x-card.wrapper>
						<x-card.thumbnail src="{{ $image->url }}" href="{{ route('images.show', compact('image')) }}" />
					</x-card.wrapper>
				</x-column>
			@endforeach
		</x-row>
	@endforeach
	<x-row flex-class="null">
		<x-column class="block w-full">
			<div class="px-6 pt-6">
				{{ $images->links() }}
			</div>
		</x-column>
	</x-row>
@endsection
