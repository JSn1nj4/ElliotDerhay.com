@php /** @var App\Models\Project $project */ @endphp
<div class="md:w-1/2 lg:w-1/3 project">
	<div class="px-4">
		<x-card.wrapper size="md" padding="p-0">

			@if($project->image)
			<x-card.thumbnail
				:href="$project->demo_link ?? $project->link"
				:src="$project->image->url"
				:target="$project->demo_link ? '_self' : '_blank'"/>
			@endunless

			<div class="p-4">
				<x-card.title>
					<a href="{{ $project->link }}">{{ $project->name }}</a>
				</x-card.title>
				<p>{{ $project->short_desc }}</p>
			</div>

			<div class="flex flex-row pb-4">
				<div class="relative flex-grow">
					<p>
						<x-project.link :href="$project->link" target="_blank" title="Open project repository">
							Project <i class="fas fa-link inline"></i>
						</x-project.link>
					</p>
				</div>

				@if (!empty($project->demo_link))
					<div class="text-right relative">
						<p>
							<x-project.link :href="$project->demo_link" title="Open project demo">
								Demo <i class="fas fa-laptop inline"></i>
							</x-project.link>
						</p>
					</div>
				@endif
			</div>

		</x-card.wrapper>
	</div>
</div>
