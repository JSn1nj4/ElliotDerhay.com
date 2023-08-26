@php
/**
 * @var \Illuminate\Database\Eloquent\Collection $posts
 * @var App\Models\Post $post
 */
@endphp
@extends('layouts.blog')

@section('page-title', 'Elliot\'s Tech Blog - ElliotDerhay.com')
@if($posts->count() > 0)
	@section('meta-description', "Latest post: {$posts->first()->title}")
@endif

@section('blog')
	@if($posts->count() > 0)
		@foreach($posts as $post)
			<x-post.card :post="$post" size="none" padding="p-0" margin="mb-12 last:mb-0" />
		@endforeach

	{{ $posts->links() }}
	@else
		<h1 class="text-4xl text-center mb-4">Sorry, no posts to display.</h1>
		<p class="text-2xl text-center">Check back soon!</p>
	@endif
@endsection

@section('sidebar')
	@include('partials.blog-sidebar')
@endsection
