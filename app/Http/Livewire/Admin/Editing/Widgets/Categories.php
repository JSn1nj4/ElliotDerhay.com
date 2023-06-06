<?php

namespace App\Http\Livewire\Admin\Editing\Widgets;

use App\DataTransferObjects\CategoryDTO;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Categories extends Component
{
	use AuthorizesRequests;

	public Model|null $categorizeable = null;

	public string $form;

	protected array $rules = [
		'new.title' => 'required|string|max:255',
		'new.slug' => 'string|max:100',
	];

	protected $listeners = [
		'category.create' => 'saveNew',
		'updated' => '$refresh',
	];

	public array|null $new;

	public function boot(): void
	{
		// load related categories if categorizeable model available
		$this->categorizeable?->load('categories');
	}

	public function getCategoriesProperty()
	{
		return Category::orderBy('title')
			->limit(100)
			->get()
			->map(function (Category $item) {
				$item['checked'] = $this->modelHas($item);

				return $item;
			});
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
		$this->authorize('save-category');

		$this->new = compact('title');

		$this->validate();

		$dto = new CategoryDTO($this->sanitize($this->new['title']));

		$this->new = null;

		$category = Category::firstOrCreate(['slug' => $dto->slug], [
			'title' => $dto->title,
		]);

		$this->categorizeable
			?->categories()
			->attach($category->id);

		$this->emit('updated');
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
