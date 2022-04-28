<div class="md:w-1/2 lg:w-1/3 project">
	<div class="px-4">
		<x-card.wrapper size="md" padding="p-0">

			<x-card.thumbnail
				:href="$project->demo_link ?? $project->link"
				:src="$project->thumbnail"
				:target="$project->demo_link ? '_self' : '_blank'"/>

			<div class="p-4">
				<x-card.title>
					<a href="{{ $project->link }}">{{ $project->name }}</a>
				</x-card.title>
				<p>{{ $project->short_desc }}</p>
			</div>

			<div class="flex flex-row pb-4">
				<div class="relative flex-grow">
					<p>
						<a href="{{ $project->link }}"
							class="no-underline uppercase p-4 rounded-bl-lg" target="_blank"
							title="Open project repository">Project <i class="fas fa-link"></i></a>
					</p>
				</div>

				@if (!empty($project->demo_link))
					<div class="text-right relative">
						<p>
							<a href="{{ $project->demo_link }}"
								class="no-underline uppercase p-4 rounded-br-lg"
								title="Open project demo">Demo <i class="fas fa-laptop" style="display: inline !important;"></i></a>
						</p>
					</div>
				@endif
			</div>

		</x-card.wrapper>
	</div>
</div>
