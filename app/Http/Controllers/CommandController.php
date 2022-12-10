<?php

namespace App\Http\Controllers;

use App\Models\Command;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommandController extends Controller
{
	public function index(Request $request): View
	{
		return view('admin.commands.index', [
			'commands' => Command::index($request),
		]);
	}

	public function create(): View
	{
		return view('admin.commands.create');
	}

	public function show(Command $command): View
	{
		return view('admin.commands.show', compact('command'));
	}

	public function edit(Command $command): View
	{
		return view('admin.commands.edit', compact('command'));
	}

	public function destroy(Command $command): Response|RedirectResponse
	{
		$command->delete();

		session()->flash('success', 'Command deleted!');

		return redirect()->route('commands.index');
	}
}
