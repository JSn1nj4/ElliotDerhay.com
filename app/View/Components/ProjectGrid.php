<?php

namespace App\View\Components;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection as ModelCollection;
use Illuminate\View\Component;

class ProjectGrid extends Component
{
	public ModelCollection $projects;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(int $count = 9)
    {
        $this->projects = Project::latest()->take($count)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.project-grid');
    }
}
