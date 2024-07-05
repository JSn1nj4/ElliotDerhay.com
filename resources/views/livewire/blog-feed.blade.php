<?php

use Livewire\Attributes\{Computed, Layout, Title};

new
#[Layout('components.layouts.blog')]
class extends \Livewire\Volt\Component {
	use \Livewire\WithPagination;

	#[Computed]
	public function hasPosts(): bool
	{
		return $this->with()['posts']->count() > 0;
	}

	public function with(): array
	{
		return [
			'posts' => \App\Models\Post::latest('published_at')->paginate(10),
		];
	}
}; ?>


<x-slot:title>Elliot's Tech Blog - ElliotDerhay.com</x-slot:title>
@if($this->hasPosts())
	<x-slot:meta-description>Latest post: {{$posts->first()->title}}</x-slot:meta-description>
@endif

<root>
	@if($this->hasPosts())
		@foreach($posts as $post)
			<x-post.card :post="$post" size="none" padding="p-0" margin="mb-12 last:mb-0" />
		@endforeach
		{{ $posts->links() }}
	@else
		<h1 class="text-4xl text-center mb-4">Sorry, no posts to display.</h1>
		<p class="text-2xl text-center">Check back soon!</p>
	@endif
</root>

<x-slot:sidebar>
	@include('partials.blog-sidebar')
</x-slot:sidebar>
