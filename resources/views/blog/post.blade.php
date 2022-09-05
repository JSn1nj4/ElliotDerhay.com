@php /** @var App\Models\Post $post */ @endphp
@extends('layouts.blog')

@section('blog')
	<img src="{{ $post->cover_image }}" class="block rounded-lg" alt="">
	<h1 class="content-title text-4xl pt-3 mt-2">{{ $post->title }}</h1>
	@if($post->categories->count() > 0)
		<p class="my-1 text-lg">
			Categories:
			@foreach($post->categories as $cat_i => $category)
				@unless($cat_i === 0), @endunless<a href="/category/{{ $category->slug }}">{{ $category->title }}</a>
			@endforeach
		</p>
	@endif
	@if($post->tags->count() > 0)
		<p class="my-1 text-lg">
			Tags:
			@foreach($post->tags as $tag_i => $tag)
				@unless($tag_i === 0), @endunless<a href="/tag/{{ $tag->slug }}">#{{ $tag->title }}</a>
			@endforeach
		</p>
	@endif
	<p class="mb-4 mt-3 text-xl">{{ $post->body }}</p>
@endsection

@section('sidebar')
	@include('partials.blog-sidebar')
@endsection
