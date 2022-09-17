@php /** @var App\Models\Post $post */ @endphp
@extends('layouts.blog')

@section('blog')
	<img src="{{ $post->cover_image }}" class="block rounded-lg" alt="">
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
	<div class="mb-4 mt-3">
		{{-- {{ $post->body }} --}}
<x-markdown>
# test heading level 1

## test heading level 2

### test heading level 3

#### test heading level 4

##### test heading level 5

###### test heading level 6

--------

test paragraph

- list item 1
- list item 2
- list item 3

1. numbered list item
2. numbered list item
3. numbered list item
</x-markdown>
	</div>
@endsection

@section('sidebar')
	@include('partials.blog-sidebar')
@endsection
