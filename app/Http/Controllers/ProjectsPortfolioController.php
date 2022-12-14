<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsPortfolioController extends Controller
{

	public function __construct()
	{
		if (!config('app.enable-projects')) {
			abort(404);
		}
	}

	public function index(Request $request, int $count = 10)
	{
		$projects = Project::take($count)->get();

		if($request->wantsJson()) {
			return $projects;
		}

		return view('projects.index', compact('projects'));
	}
}
