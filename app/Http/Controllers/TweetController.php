<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Database\Eloquent\Collection;

class TweetController extends Controller
{
	public function index(int $count = 5): Collection
	{
		return Tweet::with('user')
			->latest('date')
			->take($count)
			->get();
	}
}
