export class ScrollEffectsController {
	static init() {
		new ScrollEffectsController().init()
	}
	init() {
		window.addEventListener('scroll', this.enableScrollEffects.bind(this))
		window.addEventListener('scrollend', this.disableScrollEffects.bind(this))

		window.addEventListener('load', () => {
			window.addEventListener(
				'livewire:navigated',
				this.scrollEffectInit.bind(this),
			)
			this.scrollEffectInit()
		})
	}

	enableScrollEffects() {
		document.documentElement.classList.add('scroll')
	}

	disableScrollEffects() {
		document.documentElement.classList.remove('scroll')
	}

	scrollEffectInit() {
		this.disableScrollEffects()
	}
}
