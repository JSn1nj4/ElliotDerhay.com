export class PageMeasurementsModel {
	getScrollableDistance() {
		return (
			document.documentElement.scrollHeight -
			document.documentElement.clientHeight
		)
	}

	initMeasurements() {
		this.setStaticMeasurements()
		this.setScrollPercent()
	}

	static register() {
		const model = new PageMeasurementsModel()
		model.register()
	}

	register() {
		window.addEventListener('scroll', this.setScrollPercent.bind(this))

		window.addEventListener('load', () => {
			window.addEventListener(
				'livewire:navigated',
				this.initMeasurements.bind(this),
			)
			this.initMeasurements()
		})

		window.addEventListener('resize', this.setStaticMeasurements.bind(this))

		this.setStaticMeasurements()
	}

	setStaticMeasurements() {
		document.documentElement.style.setProperty(
			'--body-height',
			`${document.documentElement.scrollHeight}px`,
		)
		document.documentElement.style.setProperty(
			'--scrollable-distance',
			this.getScrollableDistance().toString(),
		)
	}

	setScrollPercent() {
		document.documentElement.style.setProperty(
			'--scroll-percent',

			/* basically: scroll position / (document - viewport) */
			(
				document.documentElement.scrollTop / this.getScrollableDistance()
			).toString(),
		)
	}
}
