@php /** @var App\Models\Post $post */ @endphp
@if($post !== null)
	<x-post.card :post="$post" size="none" padding="p-0" margin="mb-0" />
@endif
