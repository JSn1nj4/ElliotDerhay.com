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
	<h3 class="text-xl">Widget 1</h3>
	<hr>
	<h3 class="text-xl">Widget 2</h3>
	<hr>
	<h3 class="text-xl">Widget 3</h3>
@endsection
