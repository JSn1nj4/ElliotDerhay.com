@php
	$count = (int) ($count ?? 12);
	$loaderSize = $loaderSize ?? '40px';
@endphp

<div class="grid grid-cols-1 md:grid-cols-3 projects-list gap-8" style="min-height: {{ $loaderSize }}">
	@each('partials.project-card', $projects, 'project')
</div>
