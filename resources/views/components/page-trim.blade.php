<div
	@class([
		'absolute' => true,
		'top-0' => true,
		'left-0' => !$mirror,
		'right-0' => $mirror,
		'z-10' => true,
		'w-32' => true,
		'-scale-x-100' => $mirror,
		'h-full' => true,
		'opacity-0' => true,
		'dark:opacity-100' => true,
		'dark2:opacity-0' => true,
		'transition-opacity' => true,
		'transition-1000' => true,
		'bg-repeat-y' => true,
		'bg-size-[101%_auto]' => true,
		'bg-position-[left_0_top_5.3rem]' => !$mirror,
		'bg-position-[right_0_top_5.3rem]' => $mirror,
	])
	style='background-image: url({{ asset_url('circuit-traces-transparent.png') }});'
>
	<div
		@class([
			'relative' => true,
			'w-full' => true,
			'h-full' => true,
			'opacity-100' => true,
			'dark:animate-pulse-100' => true,
			'dark2:md:animate-none' => true,
			'bg-repeat-y' => true,
			'bg-size-[101%_auto]' => true,
			'bg-position-[left_0_top_5.3rem]' => !$mirror,
			'bg-position-[right_0_top_5.3rem]' => $mirror,
	])
		style='background-image: url({{ asset_url('circuit-traces-glow.png') }});'
	></div>
</div>
