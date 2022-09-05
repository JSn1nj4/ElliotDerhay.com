@php /** @var App\Models\Post $post */ @endphp
@extends('layouts.blog')

@section('blog')
	<img src="{{ $post->cover_image }}" class="block rounded-lg" alt="">
	<h1 class="content-title text-4xl pt-3 mt-2">{{ $post->title }}</h1>
	<p class="mb-4 text-xl">{{ $post->body }}</p>
@endsection

@section('sidebar')
	@include('partials.blog-sidebar')
@endsection
