<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Badge extends Component
{
    public $color;
    public $description;
    public $outline;

    public function __construct($color, $description, $outline)
    {
        $this->color = $color;
        $this->description = $description;
        $this->outline = $outline;
    }

    public function render(): View|Closure|string
    {
        return view('components.badge');
    }
}
