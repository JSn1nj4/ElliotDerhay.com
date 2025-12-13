@php
	/**
	 * @var \App\Models\Category[] $categories
	 * @var \App\Enums\DisplayMode $displayMode
	 */
@endphp
<x-widget.wrapper title="Categories">
	@if($displayMode->value === 'inline')
		@foreach($categories as $category)
			<span
				class='inline-block lg:inline m-1 lg:m-0 border border-slate-600 lg:border-0 rounded lg:rounded-none bg-white dark:bg-neutral-950 lg:bg-transparent dark:lg:bg-transparent px-2 py-1 lg:p-0'>
				<a href="{{ route('blog', compact('category')) }}">
					{{ $category->title }}
				</a>
			</span>
			<span class="hidden lg:last:hidden">, </span>
		@endforeach
	@else
		<ul class='list-none lg:list-disc pl-0 lg:pl-5 overflow-hidden'>
			@foreach($categories as $category)
				<li
					class='float-left clear-both lg:float-none my-1 lg:my-0 border border-slate-300 dark:border-slate-600 lg:border-0 rounded lg:rounded-none bg-white dark:bg-neutral-950 lg:bg-transparent dark:lg:bg-transparent px-2 py-1 lg:p-0'>
					{{-- <a href="{{ route('blog.category.show', compact('category')) }}"> --}}
					<a href="{{ route('blog', compact('category')) }}">
						{{ $category->title }}
					</a>
				</li>
			@endforeach
		</ul>
	@endif
</x-widget.wrapper>
