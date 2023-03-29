@php /** @var \App\Models\Category[] $categories */ @endphp
<div>
	@switch($display)
		@case('inline')
			@foreach($categories as $category)
				<span>
					<a href="{{ route('blog', compact('category')) }}">
						{{ $category->title }}
					</a>
				</span>
				<span class="last:hidden">, </span>
			@endforeach
			@break

		@default
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

	@endswitch
</div>
