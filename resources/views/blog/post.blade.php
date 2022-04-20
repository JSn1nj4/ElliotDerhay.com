@extends('layouts.blog')

@section('blog')
	<h1>{{ $post->title }}</h1>
	<p>{{ $post->body }}</p>
@endsection

@section('sidebar')
	<h3 class="text-xl">Widget 1</h3>
	<hr>
	<h3 class="text-xl">Widget 2</h3>
	<hr>
	<h3 class="text-xl">Widget 3</h3>
@endsection
