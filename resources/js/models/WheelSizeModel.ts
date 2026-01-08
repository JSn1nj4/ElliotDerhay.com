export class WheelSizeModel {
	wheel: HTMLElement

	recordWheelSize() {
		document.documentElement.style.setProperty(
			'--wheel-outer-radius',
			(this.wheel.offsetWidth / 2).toString(),
		)
	}

	static register() {
		new WheelSizeModel().register()
	}

	register() {
		this.wheel = document.querySelector<HTMLElement>('.scroller-housing .wheel')

		window.addEventListener('load', this.recordWheelSize.bind(this))
		window.addEventListener('resize', this.recordWheelSize.bind(this))
		window.addEventListener(
			'livewire:navigated',
			this.recordWheelSize.bind(this),
		)
	}
}
