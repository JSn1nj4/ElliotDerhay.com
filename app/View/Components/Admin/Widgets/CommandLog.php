<?php

namespace App\View\Components\Admin\Widgets;

use App\Models\CommandEvent;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class CommandLog extends Component
{
	public Collection $events;

    public function __construct(int $count = 3)
    {
        $this->events = CommandEvent::latest()
			->with('command')
			->limit($count)
			->get();
    }

    public function render(): View
    {
        return view('components.admin.widgets.command-log');
    }
}
