<script type="application/javascript">
	const lightboxables = document.querySelectorAll('img.lightbox-trigger')

	function triggerPopup(e) {
		const event = new CustomEvent('lightbox.show', { detail: e.target })
		document.dispatchEvent(event)
	}

	lightboxables.forEach((img) => {
		img.addEventListener('click', triggerPopup)
	})
</script>
