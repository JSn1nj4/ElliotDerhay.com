<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" color-theme="system" class='navigating'>
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
	class="relative bg-big-stone-100 dark:bg-big-stone-950 text-black dark:text-white font-sans flex flex-col {{ $bodyClasses ?? '' }} max-w-screen overflow-x-clip transition-colors navigating:transition-none duration-300">
<div
	class='absolute top-0 left-0 w-full h-full opacity-0 dark2:opacity-100 blur-sm transition-opacity'
	style='background: url({{ asset_url('blue-grunge-stone-texture-background-2-tiled.jpg') }})'></div>

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
<main class="bg-big-stone-100 dark:bg-black/60 dark2:bg-transparent flex flex-col grow z-10">
	<div class='flex flex-col z-20'>
		{{ $slot }}
	</div>
	<x-page-trim />
	<x-page-trim mirror />
</main>

@include('partials.footer')

@include('partials.cookie-popup')

@isset($footerExtras)
	{{ $footerExtras }}
@endisset

<x-scroller.housing />
<x-scroller.housing mirror />

<livewire:lightbox />

@vite('resources/js/app.ts')
</body>
</html>
