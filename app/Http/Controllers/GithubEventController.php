<?php

namespace App\Http\Controllers;

use App\Models\GithubEvent;
use Illuminate\Database\Eloquent\Collection;

class GithubEventController extends Controller
{
	public function index(int $count = 7): Collection
	{
		return GithubEvent::with('user')
			->latest('date')
			->take($count)
			->get();
	}
}
