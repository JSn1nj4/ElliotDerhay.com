@unless ($projects->isEmpty())
	<div class="grid grid-cols-1 md:grid-cols-3 projects-list gap-8">
		@each('partials.project-card', $projects, 'project')
	</div>
@endunless
