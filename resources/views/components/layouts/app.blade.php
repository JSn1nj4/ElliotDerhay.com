<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" color-theme="system">
<head>
	<x-head-meta
		:title="$title ?? config('app.name', 'Laravel')"
		:description="$metaDescription ?? 'A simple guy who loves web development and design'"
	/>

	@vite('resources/css/app.css')

	<link rel="shortcut icon" href="{{ asset_url('favicon.png') }}">

	@isset($headExtras)
		{{ $headExtras }}
	@endisset

	<livewire:google-analytics />
</head>
<body class="bg-white dark:bg-black text-black dark:text-white font-sans flex flex-col {{ $bodyClasses ?? '' }}">

@component('partials.header')
	<x-nav>
		<x-nav-item route="home" icon="m-home" inline livewire>Home</x-nav-item>
		@if(config('app.enable-blog'))
			<x-nav-item route="blog" inline livewire>Blog</x-nav-item>
		@endif
		@if(config('app.enable-projects'))
			<x-nav-item route="portfolio" inline livewire>Projects</x-nav-item>
		@endif
	</x-nav>
@endcomponent

<!-- Page Content -->
<main class="bg-white dark:bg-black layer-shadow flex flex-col flex-grow">
	{{ $slot }}
</main>

@include('partials.footer')

@vite('resources/js/app.ts')

@include('partials.cookie-popup')

@isset($footerExtras)
	{{ $footerExtras }}
@endisset

<livewire:lightbox />

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

	anchors.forEach(function (elem) {
		elem.addEventListener('click', copyOnClick, {capture: true})
	})
</script>

@include('partials.dark-mode')
</body>
</html>
