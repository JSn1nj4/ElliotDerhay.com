<script type="application/javascript">
	const lightboxTriggers = document.querySelectorAll('img.lightbox-trigger')

	function triggerPopup({target}) {
		const imageData = {
			src: target.src,
		}

		if (target?.alt) imageData.alt = target.alt
		if (target?.srcset) imageData.srcset = target.srcset
		if (target?.title) imageData.title = target.title

		const event = new CustomEvent('lightbox.show', { detail: imageData })
		document.dispatchEvent(event)
	}

	lightboxTriggers.forEach((trigger) => {
		trigger.addEventListener('click', triggerPopup)
	})
</script>
