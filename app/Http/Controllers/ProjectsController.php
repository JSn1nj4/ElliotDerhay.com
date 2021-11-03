<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ProjectsController extends Controller
{

	public function __construct()
	{
		if (!config('app.enable-' . Route::currentRouteName())) {
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
