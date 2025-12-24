<figure @class([
	'lightbox-trigger' => $lightbox,
	'inline-block' => true,
	'transition-all' => true,
	'duration-300' => true,
	'ease-linear' => true,
	'outline-solid' => true,
	'outline-1' => true,
	'rounded-lg' => true,
	'mt-1' => true,
	'outline-slate-300' => true,
	'dark:outline-big-stone-700' => true,
	'bg-white' => true,
	'dark:bg-black/60' => true,
	'hover:outline-bright-turquoise-600' => $lightbox,
	'dark:hover:outline-bright-turquoise-200' => $lightbox,
]) class="lightbox-trigger inline-block">
	<img
		src='{{ $src }}'
		@isset($title) title='{{ $title }}' @endisset
		@isset($alt) alt='{{ $alt }}' @endisset
		class='block rounded-lg'
	>
	@isset($caption)
		<figcaption class='my-2 px-4 py-2 italic text-center'>
			{{ $caption }}
		</figcaption>
	@endisset
</figure>
