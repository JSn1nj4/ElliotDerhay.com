<!doctype html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="theme-color" content="#090909">

		<title>ElliotDerhay.com</title>

		<link rel="stylesheet" href="{{ mix('/css/app.css') }}">
		<script src="https://kit.fontawesome.com/a9f488e9e4.js" crossorigin="anonymous"></script>

		<link rel="shortcut icon" href="https://s3.amazonaws.com/elliotderhay-com/favicon.png">

		@yield('head-extras')

		<script type="application/javascript">
			// Enable or disable GA tracking
			function ga_track(track){
				document.cookie = !track ? 'DNT=1' : 'DNT=0';
				window['ga-disable-UA-165049241-1'] = !track;
			}

			// Initial DNT setup
			ga_track(document.cookie.indexOf('DNT=0') !== -1 && navigator.doNotTrack !== '1');

			// tracking configuration
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', 'UA-165049241-1');
		</script>
	</head>
	<body class="bg-gray-900 text-white font-sans flex flex-col {{ $bodyClasses }}">
		@yield('body')

		@yield('footer-extras')
	</body>
</html>
