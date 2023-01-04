@php /** @var App\Models\Post $post */ @endphp
@extends('layouts.blog')

@section('blog')
	@if($post->image)
		<img src="{{ $post->image->path }}" class="block rounded-lg" alt="">
	@endif

	<div class="flex flex-row pt-3 mt-2 gap-4">
		<p>Posted {{ $post->created_at->toFormattedDateString() }}</p>
		@unless($post->created_at->unix() === $post->updated_at->unix())
			<p class="flex-grow-1">Last Updated {{ $post->updated_at->toFormattedDateString() }}</p>
		@endunless
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
@endsection

@section('sidebar')
	@include('partials.blog-sidebar')
@endsection
