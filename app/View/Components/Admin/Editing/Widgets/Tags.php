<?php

namespace App\View\Components\Admin\Editing\Widgets;

use App\Models\Tag;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Tags extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
		public $errors = null,
		public Collection|string|null $tags = null
	)
    {
        $this->prepareData();
    }

	private function prepareData(): void
	{
		if ($this->tags === null) $this->tags = '';

		if (is_string($this->tags)) return;

		$this->tags = $this->tags
			->transform(static fn (Tag $tag) => $tag->title)
			->implode(', ');
	}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.editing.widgets.tags');
    }
}
