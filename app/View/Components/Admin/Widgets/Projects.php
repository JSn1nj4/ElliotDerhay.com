<?php

namespace App\View\Components\Admin\Widgets;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Projects extends Component
{
	public Collection $projects;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(int $count = 3)
    {
        $this->projects = Project::latest()
			->limit($count)
			->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.widgets.projects');
    }
}
