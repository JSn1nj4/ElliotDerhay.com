<?php

use Livewire\Volt\Component;

new class extends Component {
	public int $speed;
	public string $timing;
	public bool $transition;

	public function mount()
	{
		$this->speed = 200;
		$this->timing = 'linear';
	}
}; ?>

<div>
	<script>
		document.addEventListener('alpine:init', function () {

			Alpine.data('lightbox', () => ({
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
				visible: false,

				init() {
					this.image = this.defaultData

					document.addEventListener('lightbox.show', this.receiveImage.bind(this))

					const lightboxTriggers = document.querySelectorAll('figure.lightbox-trigger')

					lightboxTriggers.forEach((trigger) => {
						trigger.addEventListener('click', this.triggerPopup.bind(this))
					})
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

				triggerUpdate(data) {
					this.image = data
				},

				getNodeType(elem) {
					return elem.type || elem.nodeName.toLowerCase()
				},

				getLightboxSource(elem) {
					// the target should be a `<figure>` containing an `<img>`
					// the target might contain a `<figcaption>`
					if (this.getNodeType(elem) === 'img') elem = elem.parentElement

					return elem
				},

				getChildNodes(parent) {
					const nodes = {}

					parent.childNodes.forEach((node) => {
						let type = this.getNodeType(node)

						if (!['img', 'figcaption'].includes(type)) return

						nodes[type] = node
					})

					return nodes
				},

				getLightboxData(elem) {
					const {img, figcaption} = this.getChildNodes(elem)

					const data = {
						src: img.src,
					}

					if (img?.alt) data.alt = img.alt
					if (img?.srcset) data.srcset = img.srcset
					if (img?.title) data.title = img.title

					if (figcaption !== undefined) data.caption = figcaption.textContent

					return data
				},

				triggerPopup(e) {
					const elem = this.getLightboxSource(e.target)

					const lightboxData = this.getLightboxData(elem)

					const event = new CustomEvent('lightbox.show', {detail: lightboxData})
					document.dispatchEvent(event)
				},
			}))
		})
	</script>
	<section
		x-data="lightbox"
		class="lightbox overlay fixed transition-opacity bg-black/50 w-full min-h-screen top-0"
		:class="{
			'z-50': front,
			'-z-50': !front,
			'opacity-0': !visible,
		}"
		:style="{
			'transition-duration': `${speed}ms`,
			'transition-timing-function': $wire.timing,
		}"
	>
		<button @click="maybeClose()" class="absolute top-2 right-4 text-4xl z-50">&times;</button>
		<div class="relative min-h-screen max-h-screen px-16 py-8">
			{{--	START: captionable image	--}}
			<figure class="relative block overflow-hidden rounded-lg">
				<img
					class="relative mx-auto object-contain"
					:src="image.src"
					:alt="image.alt"
					:title="image.title"
					:srcset="image.srcset"
				>
				<figcaption
					x-show="image.caption"
					class="caption absolute bottom-0 left-0 block w-full p-4 text-center bg-black/30"
					x-text="image.caption"
				></figcaption>
			</figure>
			{{--	END: captionable image	--}}
		</div>
	</section>
	<style lang="text/css">
		.lightbox img {
			max-height: calc(100vh - theme('spacing.8') * 2);
		}
	</style>
</div>
