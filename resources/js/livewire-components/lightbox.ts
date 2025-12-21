// @ts-ignore
// hack to make TS ok with using global Alpine loaded by Livewire
import {LightboxCandidateClicked} from '../events/LightboxCandidateClicked'

declare global {
	interface Window {
		Alpine: any
	}
}

export interface LightboxData {
	src?: string
	alt?: string
	srcset?: string
	title?: string
	caption?: string
}

window.Alpine.data('lightbox', (speed: number) => ({
	defaultData: {
		alt: null,
		caption: null,
		src: '',
		srcset: null,
		title: null,
	} as LightboxData,

	front: false as boolean,
	image: null as LightboxData | null,

	speed: speed,
	visible: false as boolean,

	init() {
		this.image = this.defaultData

		document.addEventListener(
			LightboxCandidateClicked.name,
			this.receiveImage.bind(this),
		)

		const lightboxTriggers = document.querySelectorAll(
			'figure.lightbox-trigger',
		)

		lightboxTriggers.forEach((trigger: HTMLElement) => {
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

	receiveImage(e: LightboxCandidateClicked) {
		this.triggerUpdate(e.data)
		this.maybeOpen()
	},

	triggerUpdate(data: LightboxData) {
		this.image = data
	},

	getNodeType(elem: Node & {type?: string}) {
		return elem.type || elem.nodeName.toLowerCase()
	},

	getLightboxSource(elem: HTMLElement) {
		// the target should be a `<figure>` containing an `<img>`
		// the target might contain a `<figcaption>`
		if (this.getNodeType(elem) === 'img') elem = elem.parentElement

		return elem
	},

	getChildNodes(parent: HTMLElement) {
		const nodes: {[key: string]: Node} = {}

		parent.childNodes.forEach((node: ChildNode) => {
			let type: string = this.getNodeType(node)

			if (!['img', 'figcaption'].includes(type)) return

			nodes[type] = node
		})

		return nodes
	},

	getLightboxData(elem: HTMLElement): LightboxData {
		const {img, figcaption}: {img: HTMLImageElement; figcaption?: HTMLElement} =
			this.getChildNodes(elem)

		const data: LightboxData = {
			src: img.src,
		}

		if (img?.alt) data.alt = img.alt
		if (img?.srcset) data.srcset = img.srcset
		if (img?.title) data.title = img.title

		if (figcaption !== undefined) data.caption = figcaption.textContent

		return data
	},

	triggerPopup(e: MouseEvent) {
		const elem: HTMLElement = this.getLightboxSource(e.target)

		document.dispatchEvent(
			new LightboxCandidateClicked(this.getLightboxData(elem)),
		)
	},
}))
