<?php

namespace App\Http\Livewire\Admin\Editing\Widgets;

use App\DataTransferObjects\CategoryDTO;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Categories extends Component
{
	use AuthorizesRequests;

	/** @var \Illuminate\Database\Eloquent\Model|\App\Contracts\CategorizeableContract|null $categorizeable */
	public Model|null $categorizeable = null;

	public string $form;

	protected array $rules = [
		'new.title' => 'required|string|min:1|max:255',
		'new.slug' => 'string|min:1|max:100',
	];

	protected $listeners = [
		'category.create' => 'saveNew',
		'categories.updated' => '$refresh',
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
			->remove([
				"{", "}", "[", "]", '<', '>',
				"`", "~", "!", "@", "#", '$',
				'%', '^', '*', '+', '=', '/',
				'\\', "\r", "\n"
			])
			->trim()
			->toString();
	}

	public function saveNew(string $title): void
	{
		$this->authorize('save-category');

		$dto = new CategoryDTO($this->sanitize($title));

		$this->new = $dto->toArray();

		$this->validate();

		$this->new = null;

		$category = Category::firstOrCreate(['slug' => $dto->slug], [
			'title' => $dto->title,
		]);

		$this->categorizeable
			?->categories()
			->attach($category->id);

		$this->categorizeable?->load('categories');

		$this->emit('categories.updated');
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
