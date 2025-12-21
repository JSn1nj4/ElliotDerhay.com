interface MaybeAnchorElement extends EventTarget {
	href?: string
	parentElement: MaybeAnchorElement
	hasAttribute(value: string): boolean
}

export class AnchorLinkController {
	static init() {
		const anchorLinkController = new AnchorLinkController()

		anchorLinkController.init()
	}

	init() {
		let anchors = document.querySelectorAll('.heading-anchor')

		anchors.forEach(
			function (elem: Node) {
				elem.addEventListener('click', this.get.bind(this), {capture: true})
			}.bind(this),
		)
	}

	get(e: MouseEvent) {
		let elem = e.target as MaybeAnchorElement

		while (!elem.hasAttribute('href')) {
			elem = elem.parentElement
		}

		const text =
			elem.href.charAt(0) === '#' ? `${window.location}${elem.href}` : elem.href

		navigator.clipboard
			.writeText(text)
			.then(value => console.log(`Link copied to clipboard: ${value}`))
	}
}
