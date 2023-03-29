<?php

namespace App\Http\Controllers;

use App\Actions\LogCommandEvent;
use App\Http\Requests\RunCommandRequest;
use App\Models\Command;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;

class RunCommandController extends Controller
{
    public function store(RunCommandRequest $request, LogCommandEvent $logCommandEvent): Response|RedirectResponse
	{
		try {
			Artisan::call($request->validated('command'));

			return back()->with('success', sprintf(trans('commands.run_succeeded'), $request->validated('command')));
		} catch(\Exception $exception) {
			$logCommandEvent(
				command: Command::firstWhere('signature', $request->validated('command')),
				succeeded: false,
				message: $exception->getMessage(),
			);

			return back()->withErrors(['command' => sprintf(trans('commands.run_failed'), $request->validated('command'))]);
		}
	}
}
