<?php

use App\Enums\PerPage;
use App\Features\ProjectsIndex;
use App\Models\Project;
use Laravel\Pennant\Feature;
use Livewire\Volt\Component;

new class extends Component {
	#[\Livewire\Attributes\Url(history: true)]
	public int|string|null $per_page = 12;

	public function hasProjects(): bool
	{
		return $this->with()['projects']->count() > 0;
	}

	public function boot()
	{
		if (Feature::active(ProjectsIndex::class)) return;

		abort(404);
	}

	public function mount(): void
	{
		$this->per_page = PerPage::filter($this->per_page);
	}

	public function updating($property, $value): void
	{
		// convert to array check later if more properties supported later
		if ($property != 'per_page') return;

		$this->$property = PerPage::filter($value);
	}

	public function with(): array
	{
		return [
			'projects' => Project::take($this->per_page)->get(),
		];
	}
}; ?>

<article class="container mx-auto px-4 pt-6">
	<section class="block">

		<div class="w-full pb-6 text-center">
			<div class="px-2">
				<h1 class="content-title text-4xl pt-6 mt-4 md:pt-0 md:mt-0">
					Projects
				</h1>
				<p class="mb-4">
					Below are projects that I've either built myself or contributed directly to. Some will also have links to
					demos.
				</p>
			</div>
		</div>

	</section>

	<section class="block w-full md:flex">

		<div class="w-full pb-8 px-2 pt-6 mt-4 md:pt-0 md:mt-0">
			<div id="main-projects-list-wrapper">
				@include('partials.projects-list', compact('projects'))
			</div>
		</div>

	</section>
</article>
