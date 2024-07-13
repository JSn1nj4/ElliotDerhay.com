<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" color-theme="system">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#002e24">

	<title>{{ $title ?? config('app.name', 'Laravel') }}</title>
	<meta name="description" content="{{ $metaDescription ?? 'A simple guy who loves web development and design' }}">

	@vite('resources/css/app.css')
	<script src="https://kit.fontawesome.com/a9f488e9e4.js" crossorigin="anonymous"></script>

	<link rel="shortcut icon" href="{{ asset_url('favicon.png') }}">

	@isset($headExtras)
		{{ $headExtras }}
	@endisset
	
	<livewire:google-analytics />
</head>
<body class="bg-white dark:bg-black text-black dark:text-white font-sans flex flex-col {{ $bodyClasses ?? '' }}">

@component('partials.header')
	<x-nav>
		<x-nav-item route="home" icon="fas fa-home" inline>Home</x-nav-item>
		@if(config('app.enable-blog'))
			<x-nav-item route="blog" inline livewire>Blog</x-nav-item>
		@endif
		@if(config('app.enable-projects'))
			<x-nav-item route="portfolio" inline>Projects</x-nav-item>
		@endif
	</x-nav>
@endcomponent

<!-- Page Content -->
<main class="bg-white dark:bg-black layer-shadow flex flex-col flex-grow">
	<x-row flex-class="lg:flex">
		<x-column id="blog" class="pr-8 last:pr-0 pb-12 lg:pb-0 only:w-full lg:w-2/3">
			{{ $slot }}
		</x-column>

		@isset($sidebar)
			<x-sidebar>
				{{ $sidebar }}
			</x-sidebar>
		@endisset
	</x-row>
</main>

@include('partials.footer')

@vite('resources/js/app.ts')

@include('partials.cookie-popup')

@isset($footerExtras)
	{{ $footerExtras }}
@endisset

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

	const anchors = document.querySelectorAll('.heading-anchor')

	anchors.forEach(function (elem) {
		elem.addEventListener('click', copyOnClick, {capture: true})
	})
</script>

@include('partials.dark-mode')
</body>
</html>
