@php
	$classes = $classes ?? '';
	$linkClasses = $linkClasses ?? 'mx-1';
@endphp

<p class="{{ $classes }}">
	<a href="https://github.com/JSn1nj4"
		class="{{ $linkClasses }}"
		target="_blank"><i class="fab fa-github"></i></a>
	<a href="https://twitter.com/JSn1nj4"
		class="{{ $linkClasses }}"
		target="_blank"><i class="fab fa-twitter"></i></a>
	<a href="https://www.linkedin.com/in/elliot-derhay-19508849/"
		class="{{ $linkClasses }}"
		target="_blank"><i class="fab fa-linkedin"></i></a>
	<a href="https://dev.to/jsn1nj4"
		class="{{ $linkClasses }}"
		target="_blank"><i class="fab fa-dev"></i></a>
</p>
