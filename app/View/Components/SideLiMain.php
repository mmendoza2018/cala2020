<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideLiMain extends Component
{
    /**
     * Create a new component instance.
     */
    public $description;

    public function __construct($description)
    {
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.side-li-main');
    }
}
