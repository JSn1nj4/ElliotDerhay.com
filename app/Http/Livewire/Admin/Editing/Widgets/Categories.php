<?php

namespace App\Http\Livewire\Admin\Editing\Widgets;

use App\DataTransferObjects\CategoryDTO;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection as ModelCollection;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Categories extends Component
{
	public ModelCollection $categories;

	public string $form;

	public Model|null $categorizeable = null;

	/**
	 * @var \Illuminate\Support\Collection<\App\Models\Category> $new_categories;
	 */
	public \Illuminate\Support\Collection $new_categories;

	public function boot(): void
	{
		$this->new_categories = collect([]);

		$this->categories = Category::whereNotIn('slug',
			$this->new_categories
				->map(fn (Category $cat) => $cat->slug)
				->all()
		)
			->limit(100)
			->get();

		// load related categories if categorizeable model available
		$this->categorizeable?->load('categories');
	}

	public function saveNew(string $title): void
	{
		$dto = new CategoryDTO($title);

		$this->new_categories->push(Category::firstOrCreate(['slug' => $dto->slug], [
			'title' => $dto->title,
		]));
	}

    public function render()
    {
        return view('livewire.admin.editing.widgets.categories');
    }
}
