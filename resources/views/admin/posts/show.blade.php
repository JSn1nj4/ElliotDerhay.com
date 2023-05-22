@php /** @var App\Models\Post $post */ @endphp
@extends('admin.layouts.page')

@section('content')
	<x-row flex-class="md:flex flex-col gap-6">
		<x-column class="block w-full">
			@if($post->image)
				<img src="{{ $post->image->url }}" class="lightbox-trigger block rounded-lg" alt="">
			@endif

			<div class="flex flex-row pt-3 mt-2 gap-4 text-xl">
				<p>Posted {{ $post->created_at->toFormattedDateString() }}</p>
				@unless($post->created_at->unix() === $post->updated_at->unix())
					<p class="flex-grow-1">Last Updated {{ $post->updated_at->toFormattedDateString() }}</p>
				@endunless
				<p><a class="underline" href="{{ route('blog.show', compact('post')) }}" target="public_post-{{ $post->id }}">View Public</a></p>
			</div>

			<h1 class="content-title text-4xl pt-2 mt-1">{{ $post->title }}</h1>

			@if($post->categories->count() > 0)
				<p class="my-1 text-lg">
					Categories:
					@foreach($post->categories as $cat_i => $category)
						@unless($cat_i === 0), @endunless
						<a href="{{ route('blog', compact('category')) }}">{{ $category->title }}</a>
					@endforeach
				</p>
			@endif

			@if($post->tags->count() > 0)
				<p class="my-1 text-lg">
					Tags:
					@foreach($post->tags as $tag_i => $tag)
						@unless($tag_i === 0), @endunless
						<a href="{{ route('blog', compact('tag')) }}">#{{ $tag->title }}</a>
					@endforeach
				</p>
			@endif

			<x-markdown class="mb-4 mt-3">
				 {!! $post->body !!}
			</x-markdown>

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

				<div class="block">
					<div class="flex gap-2">
						<x-ui.link
							font-size="text-2xl"
							width="w-full"
							:href="route('posts.edit', compact('post'))"
							:link-style="\App\View\Components\Ui\Enums\LinkStyle::ButtonSolid"
						>
							Edit
						</x-ui.link>
						<x-ui.form.button
							title="Delete Post"
							color="red"
							font-size="text-2xl"
							width="w-full"
							form="delete_post"
							type="submit"
						>
							Delete
						</x-ui.form.button>
						<form
							id="delete_post"
							action="{{ route('posts.destroy', compact('post')) }}"
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
