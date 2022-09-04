@php
/**
 * @var App\Models\Post[] $posts
 * @var App\Models\Post $post
 */
@endphp
@extends('layouts.blog')

@section('blog')
  @foreach($posts as $post)
		<x-card.wrapper size="none" padding="p-0" margin="mb-12 last:mb-0">
			@isset($post->cover_image)
				<x-card.thumbnail
					:href="route('blog.show', compact('post'))"
					:src="$post->cover_image"
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
@endsection

@section('sidebar')
	@if(config('blog.feature.categories_widget'))
		<x-widget.wrapper title="Categories">
			<x-widget.blog.categories display="list"/>
		</x-widget.wrapper>
	@endif

	@if(config('blog.feature.tags_widget'))
		<x-widget.wrapper title="Tags">
			<x-widget.blog.tags sort-by="count" limit="10"/>
		</x-widget.wrapper>
	@endif

	@if(config('blog.feature.latest_tweets_widget'))
		<x-widget.wrapper title="Latest Tweet">
			<x-twitter.timeline count="1"/>
		</x-widget.wrapper>
	@endif

	@if(config('blog.feature.github_activity_widget'))
		<x-widget.wrapper title="GitHub Activity">
			<x-github.events-feed count="5"/>
		</x-widget.wrapper>
	@endif
@endsection
