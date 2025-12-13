<a
	class="{{ $class }} {{ $baseClasses }}"
	href='{{ $location }}'
	@if($wireNavigate) wire:navigate @endif
>
	@isset($icon)
		{{ $icon }}
	@endisset

	@if($text !== null && $icon !== null)
		<span class='text-black dark:text-white'>{{ $text }}</span>
	@elseif($text !== null && $icon === null)
		{{ $text }}
	@endif
</a>
