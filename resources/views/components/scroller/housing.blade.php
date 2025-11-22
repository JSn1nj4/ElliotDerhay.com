<div @class([
	'absolute',
	'h-full',
	'top-0',
	'left-0' => !$mirror,
	'-scale-x-100' => $mirror,
	'right-0' => $mirror,
	'z-0',
])>
	<div class='relative h-full w-full'>
		<x-scroller.track />
	</div>
</div>
