<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" color-theme="system" class='navigating'>
<head>
	@vite('resources/css/app.css')
</head>
<body
	class="relative bg-big-stone-100 dark:bg-big-stone-950 text-black dark:text-white font-sans flex flex-col {{ $bodyClasses ?? '' }} max-w-screen overflow-x-clip transition-colors navigating:transition-none duration-300">
<div
	class='absolute top-0 left-0 w-full h-full opacity-0 dark2:opacity-100 blur-sm transition-opacity navigating:transition-none'
	style='background: url({{ asset_url('blue-grunge-stone-texture-background-2-tiled.jpg') }})'></div>

<!-- Page Content -->
<main class="bg-big-stone-100 dark:bg-black/60 dark2:bg-transparent flex flex-col grow z-10">
	<div class='flex flex-col z-20'>
		{{ $slot }}
	</div>
</main>

@vite('resources/js/preview.ts')
</body>
</html>
