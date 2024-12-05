<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideLiSubmenu2 extends Component
{
    public $description;

    public function __construct($description)
    {
        $this->description = $description;
    }

    public function render(): View|Closure|string
    {
        return view('components.side-li-submenu2');
    }
}
