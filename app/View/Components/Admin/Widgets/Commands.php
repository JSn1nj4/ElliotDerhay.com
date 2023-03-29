<?php

namespace App\View\Components\Admin\Widgets;

use App\Models\Command;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Commands extends Component
{
	public Collection $commands;

    public function __construct(int $count = 3)
    {
        $this->commands = Command::orderBy('signature')
			->limit($count)
			->get();
    }

    public function render(): View
    {
        return view('components.admin.widgets.commands');
    }
}
