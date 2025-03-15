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
	
	<link rel="shortcut icon" href="{{ asset_url('favicon.png') }}">

	@stack('head-extras')
</head>
<body class="bg-white dark:bg-black text-black dark:text-white font-sans flex flex-col status-page backlight">
<div class="flex flex-col mx-auto container px-4 py-6 pt-16 sm:pt-32 md:pt-48 xl:pt-56 justify-center">
	<div class="pb-4 w-full max-w-md mx-auto">
		<h1 class="text-xl sm:text-4xl">
			<span class="align-middle text-3xl sm:text-6xl font-extralight">{{ $errorCode }}</span>
			<span
				class="inline-block align-middle w-0 h-10 sm:h-16 border-solid border-r-2 border-caribbeanGreen-500">&nbsp;</span>
			<span class="align-middle leading-none">{{ $errorTitle }}</span>
		</h1>

		<div class="pt-4 text-md sm:text-lg leading-normal font-extralight">
			@yield('status-body')
		</div>

		<div class="pt-4">
			@yield('status-footer')
		</div>
	</div>
</div>

@stack('footer-extras')

@include('partials.dark-mode')
</body>
</html>
