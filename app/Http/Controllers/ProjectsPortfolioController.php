<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ProjectsPortfolioController extends Controller
{
	public function index(Request $request, int $count = 10): View|Factory|Collection|Application
	{
		$projects = Project::take($count)->get();

		if ($request->wantsJson()) {
			return $projects;
		}

		return view('projects.index', compact('projects'));
	}
}
