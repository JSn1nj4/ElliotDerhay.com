<?php

namespace App\View\Components\Ui\Table;

use App\View\Components\Ui\HtmlElement;

class Header extends HtmlElement
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ui.table.header');
    }
}
