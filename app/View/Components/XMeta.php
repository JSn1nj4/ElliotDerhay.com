<?php

namespace App\View\Components;

use App\DataTransferObjects\XMetaDTO;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class XMeta extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
		public XMetaDTO $metadata,
	) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.x-meta');
    }
}
