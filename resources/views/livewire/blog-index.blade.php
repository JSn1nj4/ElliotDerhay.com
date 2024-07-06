<?php

use App\Enums\PerPage;
use App\Filters\{CategoryQueryParam, TagQueryParam};
use App\Models\Post;
use Livewire\Attributes\{Computed, Layout, Title, Url};

new
#[Layout('components.layouts.blog')]
class extends \Livewire\Volt\Component {
	use \Livewire\WithPagination;

	#[Url(history: true, except: null)]
	public int|string|null $category = null;

	#[Url(history: true)]
	public int|string|null $per_page = 10;

	#[Url(history: true)]
	public int|string|null $tag = null;

	#[Computed]
	public function hasPosts(): bool
	{
		return $this->with()['posts']->count() > 0;
	}

	public function mount()
	{
		$this->category = CategoryQueryParam::filter($this->category);
		$this->per_page = PerPage::filter($this->per_page);
		$this->tag = TagQueryParam::filter($this->tag);
	}

	public function updating($property, $value): void
	{
		if (!in_array($property, ['category', 'per_page', 'tag'])) return;

		$this->$property = match ($property) {
			'category' => CategoryQueryParam::filter($value),
			'per_page' => PerPage::filter($value),
			'tag' => TagQueryParam::filter($value),
		};
	}

	public function with(): array
	{
		return [
			'posts' => Post::paged($this->per_page, $this->category, $this->tag),
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
