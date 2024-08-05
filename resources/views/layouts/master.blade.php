<!doctype html>
<html lang="{{ app()->getLocale() }}" color-theme="system">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#002e24">

	<title>@yield('page-title', 'ElliotDerhay.com')</title>
	<meta name="description" content="@yield('meta-description', 'A simple guy who loves web development and design')">

	@vite('resources/css/app.css')
	<script src="https://kit.fontawesome.com/a9f488e9e4.js" crossorigin="anonymous"></script>

	<link rel="shortcut icon" href="{{ asset_url('favicon.png') }}">

	@stack('head-extras')
</head>
<body class="bg-white dark:bg-black text-black dark:text-white font-sans flex flex-col {{ $bodyClasses }}">
@yield('body')

@stack('footer-extras')

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

	let anchors = document.querySelectorAll('.heading-anchor')

	anchors.forEach(function (elem) {
		elem.addEventListener('click', copyOnClick, {capture: true})
	})
</script>

@include('partials.dark-mode')
</body>
</html>
