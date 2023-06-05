<?php

namespace App\Http\Livewire\Admin\Editing\Widgets;

use App\Contracts\CategorizeableContract;
use App\DataTransferObjects\CategoryDTO;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection as ModelCollection;
use Livewire\Component;

class Categories extends Component
{
	public ModelCollection $categories;

	public string $form;

	public CategorizeableContract|null $categorizeable = null;

	protected $listeners = ['category.create' => 'saveNew'];


	public function boot(): void
	{
		$this->categories = Category::orderBy('title')
			->limit(100)
			->get();

		// load related categories if categorizeable model available
		$this->categorizeable?->load('categories');
	}

	protected function sanitize(string $title): string
	{
		return str($title)
			->stripTags()
			->trim()
			->remove("{}[]`~!@#\$%^*+=<>/\\\r\n")
			->toString();
	}

	public function saveNew(string $title): void
	{
		$dto = new CategoryDTO($this->sanitize($title));

		$category = Category::firstOrCreate(['slug' => $dto->slug], [
			'title' => $dto->title,
		]);

		$this->categorizeable
			?->categories()
			->attach($category->id);
	}

	public function modelHas(Category $category): bool
	{
		return $this->categorizeable
			?->categories
			->contains(static fn ($cat) => $cat->id === $category->id)
			?? false;
	}

    public function render()
    {
        return view('livewire.admin.editing.widgets.categories');
    }
}
