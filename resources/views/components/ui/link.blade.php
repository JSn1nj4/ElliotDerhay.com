<a class="{{ $classes() }}" href="{{ $href }}" {{ $attributes->merge([
	'title' => $title,
	'alt' => $alt,
]) }}>{{ $slot }}</a>
