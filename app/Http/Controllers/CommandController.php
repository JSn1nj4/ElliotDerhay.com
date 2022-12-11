<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommandRequest;
use App\Http\Requests\UpdateCommandRequest;
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

	public function store(StoreCommandRequest $request): Response|RedirectResponse
	{
		$command = Command::create($request->validated());

		session()->flash('success', 'Command registered!');

		return redirect()->route('commands.edit', compact('command'));
	}

	public function show(Command $command): View
	{
		return view('admin.commands.show', compact('command'));
	}

	public function edit(Command $command): View
	{
		return view('admin.commands.edit', compact('command'));
	}

	public function update(UpdateCommandRequest $request, Command $command): Response|RedirectResponse
	{
		$command->update($request->validated());

		return back()->with('success', 'Command saved!');
	}

	public function destroy(Command $command): Response|RedirectResponse
	{
		$command->delete();

		session()->flash('success', 'Command deleted!');

		return redirect()->route('commands.index');
	}
}
