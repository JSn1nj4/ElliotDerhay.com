@php
/**
 * @var \Illuminate\Database\Eloquent\Collection $posts
 * @var App\Models\Post $post
 */
@endphp
@extends('layouts.blog')

@section('page-title', 'Elliot\'s Tech Blog - ElliotDerhay.com')
@section('meta-description', "Latest post: {$posts->first()->title}")

@section('blog')
  @foreach($posts as $post)
		<x-post.card :post="$post" size="none" padding="p-0" margin="mb-12 last:mb-0" />
  @endforeach

	{{ $posts->links() }}
@endsection

@section('sidebar')
	@include('partials.blog-sidebar')
@endsection
