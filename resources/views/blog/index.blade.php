@php
/**
 * @var App\Models\Post[] $posts
 * @var App\Models\Post $post
 */
@endphp
@extends('layouts.blog')

@section('blog')
	{{ $posts->links() }}
	<div class="mb-12"></div>

  @foreach($posts as $post)
		<x-card.wrapper size="none" padding="p-0" margin="mb-12 last:mb-0">
			@isset($post->cover_image)
				<x-card.thumbnail
					href="{{ route('blog.show', compact('post')) }}"
					src="{{ $post->cover_image }}"
				/>
			@endif
			<div class="p-4">
				<x-card.title element="h4">
					<a href="{{ route('blog.show', compact('post')) }}">{{ $post->title }}</a>
				</x-card.title>
				<p>{{ $post->excerpt }}</p>
				<p><a href="{{ route('blog.show', compact('post')) }}">Read More</a></p>
			</div>
		</x-card.wrapper>
  @endforeach

	{{ $posts->links() }}
@endsection

@section('sidebar')
	@include('partials.blog-sidebar')
@endsection
