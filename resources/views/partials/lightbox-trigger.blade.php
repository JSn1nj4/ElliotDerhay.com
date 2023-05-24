<script type="application/javascript">
	const lightboxTriggers = document.querySelectorAll('figure.lightbox-trigger')

	function getNodeType(elem) {
		return elem.type || elem.nodeName.toLowerCase()
	}

	function getLightboxSource(elem) {
		// the target should be a `<figure>` containing an `<img>`
		// the target might contain a `<figcaption>`
		if (getNodeType(elem) === 'img') elem = elem.parentElement

		return elem
	}

	function getChildNodes(parent) {
		const nodes = {}

		parent.childNodes.forEach((node) => {
			let type = getNodeType(node)

			if (!['img', 'figcaption'].includes(type)) return

			nodes[type] = node
		})

		return nodes
	}

	function getLightboxData(elem) {
		const { img, figcaption } = getChildNodes(elem)

		const data = {
			src: img.src,
		}

		if (img?.alt) data.alt = img.alt
		if (img?.srcset) data.srcset = img.srcset
		if (img?.title) data.title = img.title

		if (figcaption !== undefined) data.caption = figcaption.textContent

		return data
	}

	function triggerPopup(e) {
		const elem = getLightboxSource(e.target)

		const lightboxData = getLightboxData(elem)

		const event = new CustomEvent('lightbox.show', { detail: lightboxData })
		document.dispatchEvent(event)
	}

	lightboxTriggers.forEach((trigger) => {
		trigger.addEventListener('click', triggerPopup)
	})
</script>
