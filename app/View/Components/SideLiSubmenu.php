<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideLiSubmenu extends Component
{
    /**
     * Create a new component instance.
     */
    public $description;
    public $url;

    public function __construct($description, $url)
    {
        $this->description = $description;
        $this->url = $url;
    }

    public function render(): View|Closure|string
    {
        return view('components.side-li-submenu');
    }
}
