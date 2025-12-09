<?php

use App\Enums\PerPage;
use App\Features\BlogIndex;
use App\Filters\{CategoryQueryParam, SearchParam, TagQueryParam};
use App\Models\Post;
use Livewire\Attributes\{Computed, Layout, On, Title, Url};
use Laravel\Pennant\Feature;

new
class extends \Livewire\Volt\Component {
	use \Livewire\WithPagination;

	#[Url(history: true, except: null)]
	public int|string|null $category = null;

	#[Url(history: true)]
	public int|string|null $per_page = 10;

	#[Url(history: true, except: '')]
	public string|null $search = '';

	#[Url(history: true)]
	public int|string|null $tag = null;

	#[Computed]
	public function hasPosts(): bool
	{
		return $this->with()['posts']->count() > 0;
	}

	public function boot()
	{
		if (Feature::active(BlogIndex::class)) return;

		abort(404);
	}

	public function mount()
	{
		$this->category = CategoryQueryParam::filter($this->category);
		$this->per_page = PerPage::filter($this->per_page);
		$this->search = SearchParam::filter($this->search);
		$this->tag = TagQueryParam::filter($this->tag);
	}

	#[On('blog-search')]
	public function refreshBlog($search): void
	{
		$this->search = SearchParam::filter($search);
	}

	public function updating($property, $value): void
	{
		if (!in_array($property, ['category', 'per_page', 'search', 'tag'])) return;

		$this->$property = match ($property) {
			'category' => CategoryQueryParam::filter($value),
			'per_page' => PerPage::filter($value),
			'search' => SearchParam::filter($value),
			'tag' => TagQueryParam::filter($value),
		};
	}

	public function with(): array
	{
		return [
			'posts' => Post::paged($this->per_page, $this->category, $this->tag, $this->search),
		];
	}
}; ?>


<x-slot:title>Elliot's Tech Blog - ElliotDerhay.com</x-slot:title>
@if($this->hasPosts())
	<x-slot:meta-description>Latest post: {{$posts->first()->title}}</x-slot:meta-description>
@endif

<article class='py-12'>
	<x-blog.wrapper>
		<section class="block w-full">
			<h1 class="content-title text-4xl uppercase">
				Elliot's Tech Blog
			</h1>
		</section>

		<section class='flex flex-col gap-12'>
			@if($this->hasPosts())
				@foreach($posts as $post)
					<x-post.card
						extra-classes='blog-post-card'
						:post="$post"
						size="none"
						padding="p-0"
						margin="m-0"
						livewire
					/>
				@endforeach
				{{ $posts->links() }}
			@else
				<div>
					<h2 class="text-2xl">Sorry, no posts to display.</h2>
					<p class="text-lg">Check back soon!</p>
				</div>
			@endif
		</section>

		<x-slot:sidebar>
			@include('partials.blog-sidebar')
		</x-slot:sidebar>
	</x-blog.wrapper>
</article>
