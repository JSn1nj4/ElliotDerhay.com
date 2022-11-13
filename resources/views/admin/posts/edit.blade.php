@php /** @var \App\Models\Post $post */ @endphp
@extends('admin.layouts.post-edit', [
    'action' => action([\App\Http\Controllers\PostsController::class, 'update'], compact('post')),
    'errors' => $errors,
    'fields' => (object) [
        'title' => old('title') ?? $post->title,
        'slug' => old('slug') ?? $post->slug,
        'body' => old('body') ?? $post->body,
		],
    'editing' => true,
])
