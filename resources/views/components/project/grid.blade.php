@unless ($projects->isEmpty())
	<div class="block md:flex flex-wrap projects-list pb-4">
		@each('partials.project-card', $projects, 'project')
	</div>
@endunless
