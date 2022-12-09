<?php

namespace App\Http\Controllers;

use App\Models\CommandEvent;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CommandEventController extends Controller
{
	public function index(Request $request): View
	{
		return view('admin.command-log.index', [
			'events' => CommandEvent::index($request),
		]);
	}
}
