@php /** @var App\Models\Post $post */ @endphp
@extends('layouts.blog')

@section('page-title', $post->page_title)
@section('meta-description', $post->meta_description)

@section('blog')
	@if($post->image)
		<figure class="lightbox-trigger inline-block">
			<img src="{{ $post->image->url }}" class="block rounded-lg" alt="">
		</figure>
	@endif

	<div class="flex flex-row pt-3 mt-2 gap-4">
		<p>Published {{ $post->published_at->toFormattedDateString() }}</p>
		@unless($post->published_at->unix() === $post->updated_at->unix())
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

@prependonce('footer-extras')
	<div id="lightbox-modal"></div>
@endprependonce

@pushonce('footer-extras')
	@include('partials.lightbox-trigger')
@endpushonce
