@extends('layouts.blog')

@section('blog')
  @foreach($posts as $post)
		<x-card.wrapper size="none">
			<h2><a href="{{ route('blog.show', compact('post')) }}">{{ $post->title }}</a></h2>
			<p>{{ $post->excerpt }}</p>
			<p><a href="{{ route('blog.show', compact('post')) }}">Read More</a></p>
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

