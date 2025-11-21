<div id='decorative_frame' class='absolute -z-10 h-full w-full'>
	<!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
</div>
<script type='application/javascript'>
	function getWindowHeight() {
		document
			.getElementById('decorative_frame')
			.style
			.setProperty('--body-height', `${document.documentElement.scrollHeight}px`)
	}

	window.addEventListener('resize', getWindowHeight)

	getWindowHeight()
</script>
