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

<article class="container-flexible flex flex-col gap-12 mx-auto px-4 sm:px-8 md:px-16 lg:px-32 my-12">
	<section class="block">
		<div class="w-full text-center">
			<div>
				<h1 class="content-title text-4xl uppercase">
					Projects
				</h1>
				<p>
					Below are projects that I've either built myself or contributed directly to. Some will also have links to
					demos.
				</p>
			</div>
		</div>
	</section>

	<section class="block w-full md:flex">
		<div class="w-full">
			<div id="main-projects-list-wrapper">
				@include('partials.projects-list', compact('projects'))
			</div>
		</div>
	</section>
</article>
