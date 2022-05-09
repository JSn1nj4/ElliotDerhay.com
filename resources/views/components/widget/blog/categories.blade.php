<div>
	@switch($display)
		@case('inline')
			@foreach($categories as $category)
				<span>
					<a href="/category/{{ $category->slug }}">
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
						<a href="/category/{{ $category->slug }}">
							{{ $category->title }}
						</a>
					</li>
				@endforeach
			</ul>

	@endswitch
</div>