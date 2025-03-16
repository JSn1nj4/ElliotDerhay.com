@php
	$classes = $classes ?? '';
	$linkClasses = $linkClasses ?? 'mx-1';
@endphp

<p class="{{ $classes }}">
	<a href="https://github.com/JSn1nj4"
		 class="{{ $linkClasses }}"
		 target="_blank">
		<x-fab-github class='size-6 inline-block' />
	</a>
	<a href="https://twitter.com/JSn1nj4"
		 class="{{ $linkClasses }}"
		 target="_blank">
		<x-fab-x-twitter class='size-6 inline-block' />
	</a>
	<a href="https://www.linkedin.com/in/elliot-derhay-19508849/"
		 class="{{ $linkClasses }}"
		 target="_blank">
		<x-fab-linkedin class='size-6 inline-block' />
	</a>
	<a href="https://dev.to/jsn1nj4"
		 class="{{ $linkClasses }}"
		 target="_blank">
		<x-fab-dev class='size-6 inline-block' />
	</a>
</p>
