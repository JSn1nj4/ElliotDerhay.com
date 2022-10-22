<a href="{{ $href }}"	{{ $attributes->class([
	'block',
	'lg:inline-block',
	'px-4',
	'py-6',
	'uppercase',
	'active' => $isActive
]) }}>
	@if($icon)
		<i class="{{$icon}}"></i>
	@endif
	{{ $slot }}
</a>
