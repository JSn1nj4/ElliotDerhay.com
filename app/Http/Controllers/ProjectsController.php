<?php

namespace App\Http\Controllers;

use App\Contracts\UploadServiceContract;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Image;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectsController extends Controller
{
    public function index(Request $request): View
    {
        return view('admin.projects.index', [
			'projects' => Project::index($request),
		]);
    }

    public function create(): View
    {
        return view('admin.projects.create');
    }

    public function store(StoreProjectRequest $request): Response|RedirectResponse
    {
		$thumbnail = Image::create(resolve(UploadServiceContract::class)
			->image($request->validated('thumbnail'))
			->toArray());

		$project = Project::create($request->safe()
			->except('thumbnail'));

		$project->images()->attach($thumbnail->id);

		session()->flash('success', 'Project published!');

		return redirect()->route('projects.edit', compact('project'));
    }

    public function show(Project $project): View
    {
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(UpdateProjectRequest $request, Project $project): Response|RedirectResponse
    {
		if ($request->has('thumbnail')) {
			$thumbnail = Image::create(resolve(UploadServiceContract::class)
				->image($request->validated('thumbnail'))
				->toArray());
		}

		$project->update($request->safe()->except('thumbnail'));

		if (isset($thumbnail)) {
			$project->images()->attach($thumbnail->id);
		}

		return back()->with('success', 'Project updated!');
    }

    public function destroy(Project $project): Response|RedirectResponse
    {
        $project->delete();

		session()->flash('success', 'Project deleted!');

		return redirect()->route('projects.index');
    }
}
