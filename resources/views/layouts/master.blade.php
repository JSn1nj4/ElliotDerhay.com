<!doctype html>
<html lang="{{ app()->getLocale() }}" color-theme="system">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="theme-color" content="#002e24">

		<title>ElliotDerhay.com</title>

		@vite('resources/css/app.css')
		<script src="https://kit.fontawesome.com/a9f488e9e4.js" crossorigin="anonymous"></script>

		<link rel="shortcut icon" href="https://s3.amazonaws.com/elliotderhay-com/favicon.png">

		@stack('head-extras')
	</head>
	<body class="bg-white dark:bg-black text-black dark:text-white font-sans flex flex-col {{ $bodyClasses }}">
		@yield('body')

		@stack('footer-extras')

		@include('partials.dark-mode')
	</body>
</html>
