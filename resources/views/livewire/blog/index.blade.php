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

<article>
	<x-blog.wrapper>
		<section class="block w-full pb-6 px-2">
			<h1 class="content-title text-4xl pt-6 mt-4 md:pt-0 md:mt-0">
				Elliot's Tech Blog
			</h1>
		</section>

		<section>
			@if($this->hasPosts())
				@foreach($posts as $post)
					<x-post.card
						extra-classes='blog-post-card'
						:post="$post"
						size="none"
						padding="p-0"
						margin="mb-12 last:mb-0"
						livewire
					/>
				@endforeach
				{{ $posts->links() }}
			@else
				<h1 class="text-4xl text-center mb-4">Sorry, no posts to display.</h1>
				<p class="text-2xl text-center">Check back soon!</p>
			@endif
		</section>

		<x-slot:sidebar>
			@include('partials.blog-sidebar')
		</x-slot:sidebar>
	</x-blog.wrapper>
</article>
