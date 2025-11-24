<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" color-theme="system">
<head>
	<x-head-meta
		:title="$title ?? config('app.name', 'Laravel')"
		:description="$metaDescription ?? 'A simple guy who loves web development and design'"
	/>

	@vite('resources/css/app.css')

	<link rel="shortcut icon" href="{{ asset_url('favicon-2026.png') }}">

	@isset($headExtras)
		{{ $headExtras }}
	@endisset

	<livewire:google-analytics />
</head>
<body
	class="relative bg-big-stone-100 dark:bg-big-stone-950 text-black dark:text-white font-sans flex flex-col {{ $bodyClasses ?? '' }}">

@component('partials.header')
	<x-nav>
		@foreach(nav(\App\Enums\NavLocation::PublicNavBar) as $item)
			<x-nav-item :route='$item->route' :icon='$item->icon' inline livewire>
				{{ $item->label }}
			</x-nav-item>
		@endforeach
	</x-nav>
@endcomponent

<!-- Page Content -->
<main class="bg-big-stone-100 dark:bg-black/60 flex flex-col grow z-0">
	{{ $slot }}
</main>

@include('partials.footer')

@vite('resources/js/app.ts')

@include('partials.cookie-popup')

@isset($footerExtras)
	{{ $footerExtras }}
@endisset

<x-scroller.housing />
<x-scroller.housing mirror />

<script type='application/javascript'>
	function scrollableDistance() {
		return document.documentElement.scrollHeight - document.documentElement.clientHeight
	}

	function setStaticMeasurements() {
		document.documentElement.style.setProperty('--body-height', document.documentElement.scrollHeight.toString())
		document.documentElement.style.setProperty('--scrollable-distance', scrollableDistance().toString())
	}

	window.addEventListener('resize', setStaticMeasurements)

	function setScrollPercent() {
		document.documentElement.style.setProperty(
			'--scroll-percent',

			/* basically: scroll position / (document - viewport) */
			(document.documentElement.scrollTop / scrollableDistance()).toString(),
		)
	}

	function enableScrollEffects() {
		document.documentElement.classList.add('scroll')
	}

	function disableScrollEffects() {
		document.documentElement.classList.remove('scroll')
	}

	window.addEventListener('scroll', setScrollPercent)
	window.addEventListener('scroll', enableScrollEffects)
	window.addEventListener('scrollend', disableScrollEffects)

	window.addEventListener('load', () => {
		setStaticMeasurements()
		setScrollPercent()
	})
</script>

<livewire:lightbox />

<script type='application/javascript'>
	function getWindowHeight() {
		document
			.documentElement
			.style
			.setProperty('--body-height', `${document.documentElement.scrollHeight}px`)
	}

	window.addEventListener('resize', getWindowHeight)

	getWindowHeight()
</script>

<script>
	// todo: organize one-off scripts within bundled JS
	function copyOnClick(e) {
		var elem = e.target

		while (!elem.hasAttribute('href')) {
			elem = elem.parentElement
		}

		const text = elem.href.charAt(0) === '#' ?
			`${window.location}${elem.href}` :
			elem.href

		navigator.clipboard.writeText(text)

		console.log(`Link copied to clipboard: ${text}`)
	}

	var anchors = document.querySelectorAll('.heading-anchor')

	anchors.forEach(function(elem) {
		elem.addEventListener('click', copyOnClick, {capture: true})
	})
</script>

@include('partials.theme')
</body>
</html>
