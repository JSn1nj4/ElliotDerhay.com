<section x-data='lightboxState' x-init='lightboxInit'
				 class="lightbox overlay fixed transition-opacity bg-black/50 w-full min-h-screen top-0"
				 :class="lightboxClasses"
				 :style="lightboxInlineStyles"
>
	<button @click="triggerClose" class="absolute top-2 right-4 text-4xl z-50">&times;</button>
	<div class="relative min-h-screen max-h-screen px-16 py-8">
		{{--	START: captionable image	--}}
		<figure class="relative block overflow-hidden rounded-lg">
			<img
				class="relative mx-auto object-contain"
				:src="imageSrc"
				:alt="imageAlt"
				:title="imageTitle"
				:srcset="imageSrcset"
			>
			<figcaption
				x-show="imageCaption"
				class="caption absolute bottom-0 left-0 block w-full p-4 text-center bg-black/30"
				x-text='imageCaption'
			></figcaption>
		</figure>
		{{--	END: captionable image	--}}
	</div>
</section>

<script type="application/javascript">
	document.addEventListener('alpine:init', () => {
		Alpine.data('lightboxState', () => ({

			defaultData: {
				alt: null,
				caption: null,
				src: '',
				srcset: null,
				title: null,
			},

			front: false,
			image: null,

			speed: {{ $speed }},
			timing: '{{ $timing }}',
			transition: {{ $transition }},
			visible: false,

			imageAlt() {
				return this.image.alt
			},

			imageCaption() {
				return this.image.caption
			},

			imageSrc() {
				return this.image.src
			},

			imageSrcset() {
				return this.image.srcset
			},

			imageTitle() {
				return this.image.title
			},

			lightboxClasses() {
				return Alpine.reactive({
					'z-50': this.front,
					'-z-50': !this.front,
					'opacity-0': !this.visible,
				})
			},

			lightboxInlineStyles() {
				return Alpine.reactive({
					transitionDuration: `${this.speed}ms`,
					transitionTimingFunction: this.timing,
				})
			},

			lightboxInit(e) {
				this.image = this.defaultData

				document.addEventListener('lightbox.show', this.receiveImage.bind(this))
			},

			maybeClose() {
				if (this.front === false) return

				this.visible = false

				setTimeout(() => {
					this.front = false

					this.triggerUpdate(this.defaultData)
				}, this.speed)
			},

			maybeOpen() {
				if (this.visible === true) return

				this.front = true
				this.visible = true
			},

			receiveImage(e) {
				this.triggerUpdate(e.detail)
				this.maybeOpen()
			},

			triggerClose(e) {
				this.maybeClose()
			},

			triggerUpdate(data) {
				this.image = data
			},
		}))
	})

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
		const {img, figcaption} = getChildNodes(elem)

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

		const event = new CustomEvent('lightbox.show', {detail: lightboxData})
		document.dispatchEvent(event)
	}

	lightboxTriggers.forEach((trigger) => {
		trigger.addEventListener('click', triggerPopup)
	})
</script>
<style lang="text/css">
	.lightbox img {
		max-height: calc(100vh - theme('spacing.8') * 2);
	}
</style>
