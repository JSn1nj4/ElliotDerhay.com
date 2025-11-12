<button
	class="{{ $class }} justify-items-start place-items-center gap-2 text-left text-bright-turquoise-800 dark:text-bright-turquoise-500 hover:text-neutral-700 dark:hover:text-white transition-colors duration-300"
	title="{{ $buttonText }}"
	@if($onclick !== null) onclick='{{ $onclick }}' @endif
>
	@isset($icon)
		{{ $icon }}
	@endisset

	@if($text !== null && $icon !== null)
		<span class='text-black dark:text-white'>{{ $text }}</span>
	@elseif($text !== null && $icon === null)
		{{ $text }}
	@endif
</button>
