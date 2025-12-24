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

	recordBodyHeight() {
		document.documentElement.style.setProperty(
			'--body-height',
			`${document.documentElement.scrollHeight}px`,
		)
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
		window.addEventListener('resize', this.recordBodyHeight.bind(this))

		this.recordBodyHeight()
	}

	setStaticMeasurements() {
		document.documentElement.style.setProperty(
			'--body-height',
			document.documentElement.scrollHeight.toString(),
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
