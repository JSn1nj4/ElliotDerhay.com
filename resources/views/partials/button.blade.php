@php
	$classes = "p-3 border-gray-700 bg-gray-700 bg-opacity-30 border-solid border rounded-sm transition-colors ease-linear duration-300 hover:border-seaGreen-500 hover:bg-seaGreen-500 hover:text-gray-900";

	if($type === 'link') {
		$href ??= "javascript:void(0)";
		$target ??= "_self";
	}
@endphp

<{{ $type === 'link' ? "a href={$href} target={$target}" : "button type=\"{$type}\"" }} class="{{ $classes }}">
  {{ $slot }}
</{{ $type === 'link' ? 'a' : 'button' }}>
