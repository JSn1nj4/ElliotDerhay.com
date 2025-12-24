<figure class="lightbox-trigger inline-block">
	<img
		src='{{ $src }}'
		@isset($title) title='{{ $title }}' @endisset
		@isset($alt) alt='{{ $alt }}' @endisset
		class='block rounded-lg'
	>
	@isset($caption)
		<figcaption class='my-2 italic'>
			{{ $caption }}
		</figcaption>
	@endisset
</figure>
