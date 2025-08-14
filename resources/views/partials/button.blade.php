@php
	$classes = "p-3 border-neutral-700 bg-neutral-700/30 border-solid border rounded-xs transition-colors ease-linear duration-300 hover:border-caribbean-green-500 hover:bg-caribbean-green-500/30 hover:text-neutral-900";

	if($type === 'link') {
		$href ??= "javascript:void(0)";
		$target ??= "_self";
	}
@endphp

<{{ $type === 'link' ? "a href={$href} target={$target}" : "button type=\"{$type}\"" }} class="{{ $classes }}">
{{ $slot }}
</{{ $type === 'link' ? 'a' : 'button' }}>
