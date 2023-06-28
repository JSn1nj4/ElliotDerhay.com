@php
/**
 * @var App\Models\Image $image
 * @var App\Models\Post $post
 * @var App\Models\Project $project
 */
@endphp
@extends('admin.layouts.page')

@section('content')
	<x-row flex-class="md:flex flex-row gap-6">
		<x-column class="w-2/3">
			<figure class="lightbox-trigger inline-block">
				<img src="{{ $image->url }}" class="block rounded-lg" alt="">
			</figure>
		</x-column>
		<x-column class="w-1/3">
			<div class="mb-4 mt-3 max-w-full rounded-lg w-full bg-neutral-200 dark:bg-neutral-800">
				<div class="bg-caribbeanGreen-600/40 dark:bg-caribbeanGreen-800/20 even:bg-caribbeanGreen-200/40 dark:even:bg-caribbeanGreen-800/10 p-6 text-xl overflow-hidden overflow-ellipsis">
					<strong>Name:</strong><br>
					{{ $image->name }}
				</div>
				<div class="bg-caribbeanGreen-600/40 dark:bg-caribbeanGreen-800/20 even:bg-caribbeanGreen-200/40 dark:even:bg-caribbeanGreen-800/10 p-6 text-xl">
					<strong>Created at:</strong>
					{{ $image->created_at->toFormattedDateString() }}
				</div>
				@unless($image->created_at->unix() === $image->updated_at->unix())
				<div class="bg-caribbeanGreen-600/40 dark:bg-caribbeanGreen-800/20 even:bg-caribbeanGreen-200/40 dark:even:bg-caribbeanGreen-800/10 p-6 text-xl">
					<strong>Last Updated:</strong>
					{{ $image->updated_at->toFormattedDateString() }}
				</div>
				@endunless
				<div class="bg-caribbeanGreen-600/40 dark:bg-caribbeanGreen-800/20 even:bg-caribbeanGreen-200/40 dark:even:bg-caribbeanGreen-800/10 p-6 text-xl">
					<strong>Storage Location:</strong>
					{{ $image->disk }}
				</div>
				<div class="bg-caribbeanGreen-600/40 dark:bg-caribbeanGreen-800/20 even:bg-caribbeanGreen-200/40 dark:even:bg-caribbeanGreen-800/10 p-6 text-xl">
					<strong>Size:</strong>
					{{ $image->size }} bytes
				</div>
				<div class="bg-caribbeanGreen-600/40 dark:bg-caribbeanGreen-800/20 even:bg-caribbeanGreen-200/40 dark:even:bg-caribbeanGreen-800/10 p-6 text-xl">
					<strong>Attached to:</strong><br>
					@if($image->posts->isNotEmpty())
						<p class="pt-6">Posts:</p>
						<ul class="pl-6">
							@foreach($image->posts as $post)
								<li>{{ $post->title }}</li>
							@endforeach
						</ul>
					@endif

					@if($image->projects->isNotEmpty())
						<p class="pt-6">Projects:</p>
						<ul class="pl-6">
							@foreach($image->projects as $project)
								<li>{{ $project->name }}</li>
							@endforeach
						</ul>
					@endif
				</div>
			</div>

			<div class="flex flex-row mt-6 gap-6 justify-end">
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

@prependonce('footer-extras')
	<div id="lightbox-modal"></div>
@endprependonce

@pushonce('footer-extras')
	@include('partials.lightbox-trigger')
@endpushonce
