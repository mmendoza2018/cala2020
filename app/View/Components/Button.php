<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $color;
    public $description;
    public $outline;

    public function __construct($type, $description, $outline = false, $color)
    {
        $this->type = $type;
        $this->color = $color;
        $this->description = $description;
        $this->outline = $outline;
    }

    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
