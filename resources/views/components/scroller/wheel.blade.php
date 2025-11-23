<div @class([
	'wheel',
	'mirrored' => $mirror,
	'fixed',
	'size-20',
	'bg-conic-270',
	'from-big-stone-800',
	'via-blue-200',
	'to-big-stone-800',
	'rounded-full',
	'left-3' => !$mirror,
	'right-3' => $mirror,
	'-bottom-10',
	'z-10',
	'-scale-x-100' => $mirror,
])></div>

<script type='application/javascript'>
	window.addEventListener('scroll', () => {

		const scrollableDistance = document.documentElement.scrollHeight - document.documentElement.clientHeight

		document.documentElement.style.setProperty(
			'--scrollable-distance-legacy',

			/* basically: document - viewport */
			scrollableDistance.toString(),
		)

		document.documentElement.style.setProperty(
			'--scroll-percent-legacy',

			/* basically: scroll position / (document - viewport) */
			(document.documentElement.scrollTop / scrollableDistance).toString(),
		)

	})
</script>
