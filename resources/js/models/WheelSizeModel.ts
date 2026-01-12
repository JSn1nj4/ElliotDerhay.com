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
		window.addEventListener('load', this.setUpWheel.bind(this))
		window.addEventListener('livewire:navigated', this.setUpWheel.bind(this))
		window.addEventListener('resize', this.recordWheelSize.bind(this))
	}

	setUpWheel() {
		if (!!this.wheel) return

		this.wheel = document.querySelector<HTMLElement>('.scroller-housing .wheel')

		this.recordWheelSize()
	}
}
