@php
/**
 * @var \App\Models\Category[] $categories
 * @var \App\Enums\DisplayMode $displayMode
 */
@endphp
<x-widget.wrapper title="Categories">
	@if($displayMode->value === 'inline')
		@foreach($categories as $category)
			<span>
				<a href="{{ route('blog', compact('category')) }}">
					{{ $category->title }}
				</a>
			</span>
			<span class="last:hidden">, </span>
		@endforeach
	@else
		<ul>
			@foreach($categories as $category)
				<li>
					{{-- <a href="{{ route('blog.category.show', compact('category')) }}"> --}}
					<a href="{{ route('blog', compact('category')) }}">
						{{ $category->title }}
					</a>
				</li>
			@endforeach
		</ul>
	@endif
</x-widget.wrapper>
