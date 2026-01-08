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

		window.addEventListener('resize', this.recordWheelSize.bind(this))

		this.recordWheelSize()
	}
}
