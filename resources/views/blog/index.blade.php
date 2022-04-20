@extends('layouts.blog')

@section('blog')
  @foreach($posts as $post)
		<x-card>
			<h2><a href="/posts/{{ $post->slug }}">{{ $post->title }}</a></h2>
			<p>{{ $post->excerpt }}</p>
			<p><a href="/posts/{{ $post->slug }}">Read More</a></p>
		</x-card>
  @endforeach
@endsection

@section('sidebar')
	<h3 class="text-xl">Widget 1</h3>
	<hr>
	<h3 class="text-xl">Widget 2</h3>
	<hr>
	<h3 class="text-xl">Widget 3</h3>
@endsection

