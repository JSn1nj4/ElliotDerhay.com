<button
	class="{{ $class }} {{ $baseClasses }}"
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
