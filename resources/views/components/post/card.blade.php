@php /** @var App\Models\Post $post */ @endphp
<x-card.wrapper :size="$size" :padding="$padding" :margin="$margin">
	@if($post->image)
		<x-card.thumbnail
			href="{{ route('blog.show', compact('post')) }}"
			src="{{ $post->image->url }}"
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
