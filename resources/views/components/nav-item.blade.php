<a href="{{ $href }}" {{ $attributes->class([
	'block' => !$inline,
	'lg:inline-block' => $inline,
	'px-4',
	'py-6',
	'uppercase',
	'active' => $isActive
]) }} {{ $livewire ? 'wire:navigate' : '' }}>
	@if($icon)
		<x-dynamic-component
			:component='"heroicon-{$icon}"'
			@class([
				'w-auto',
				'h-[1em]',
				'-mt-1',
				'inline',
				'align-middle',
				'stroke-caribbeanGreen-500' => $isActive,
				'stroke-2' => $isActive,
			])
		/>
	@endif
	{{ $slot }}
</a>
