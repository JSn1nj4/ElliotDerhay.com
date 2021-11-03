@php
	$count = (int) ($count ?? 12);
	$loaderSize = $loaderSize ?? '40px';
@endphp

<div class="block md:flex flex-wrap projects-list pb-4" style="min-height: {{ $loaderSize }}">
	@each('partials.project-card', $projects, 'project')
</div>
