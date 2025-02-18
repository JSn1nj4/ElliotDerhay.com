<?php

use App\Enums\PerPage;
use App\Filters\{CategoryQueryParam, TagQueryParam};
use App\Models\Post;
use Livewire\Attributes\{Computed, Layout, Title, Url};

new
class extends \Livewire\Volt\Component {
	use \Livewire\WithPagination;

	public Post $post;

	public function mount(Post $post)
	{
		$this->post = $post;
	}
};
/** @var Post $post */
?>

{{-- using raw values here is safe because the component at the end is processing it --}}
<x-slot:title>{!! $post->page_title !!}</x-slot:title>
<x-slot:meta-description>
	Latest post: {!! $post->meta_description !!}
</x-slot:meta-description>

<x-slot:head-extras>
	@include('partials.metadata.schema-markup', [
	  'type' => 'Article',
	  'name' => $post->title,
	  'date' => $post->published_at->toIso8601ZuluString('millisecond'),
	  'image' => $post->image?->url,
	  'category' => $post->categories->first()?->title,
	  'body' => $post->body,
	])
	<x-x-meta :metadata="$post->xCardMeta()" />
	@include('partials.metadata.open-graph-markup', [
  	'type' => 'article',
  	'title' => $post->title,
  	'description' => $post->meta_description,
  	'url' => route('blog.show', compact('post')),
  	'image' => $post->image?->url,
  	'publishedTime' => $post->published_at->toIso8601ZuluString('millisecond'),
  	'modifiedTime' => match (true) {
  		$post->published_at->unix() === $post->updated_at->unix() => null,
  		default => $post->updated_at->toIso8601ZuluString('millisecond'),
  	},
	])
</x-slot:head-extras>

<x-blog.wrapper>
	@if($post->image)
		<figure class="lightbox-trigger inline-block">
			<img src="{{ $post->image->url }}" class="block rounded-lg" alt="">
			@if($post->image->caption)
				<figcaption class='my-2 italic'>{{ $post->image->caption }}</figcaption>
			@endif
		</figure>
	@endif

	<div class="flex flex-row pt-3 mt-2 gap-4">
		<time datetime="{{ $post->published_at->toIso8601ZuluString('millisecond') }}">
			Published {{ $post->published_at->toFormattedDateString() }}
		</time>
		@unless($post->published_at->unix() === $post->updated_at->unix())
			<p class="flex-grow-1">
				Last Updated {{ $post->updated_at->toFormattedDateString() }}
			</p>
		@endunless
	</div>

	<h1 class="content-title text-4xl pt-2 mt-1">{{ $post->title }}</h1>

	@if($post->categories->count() > 0)
		<p class="my-1 text-lg">
			Categories:
			@foreach($post->categories as $cat_i => $category)
				@unless($cat_i === 0)
					,
				@endunless
				<a href="{{ route('blog', compact('category')) }}">{{ $category->title }}</a>
			@endforeach
		</p>
	@endif

	@if($post->tags->count() > 0)
		<p class="my-1 text-lg">
			Tags:
			@foreach($post->tags as $tag_i => $tag)
				@unless($tag_i === 0)
					,
				@endunless
				<a href="{{ route('blog', compact('tag')) }}">#{{ $tag->title }}</a>
			@endforeach
		</p>
	@endif

	<x-markdown class="mb-4 mt-3">
		{!! $post->body !!}
	</x-markdown>

	<x-slot:sidebar>
		@include('partials.blog-sidebar')
	</x-slot:sidebar>
</x-blog.wrapper>
