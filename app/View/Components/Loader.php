<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Loader extends Component
{
    public $width;

    public $height;

    public $thickness;
    /**
     * Create a new component instance.
     */
    public function __construct($size = 4, $thickness = 4)
    {
        $this->width = $size * 0.4;
        $this->height = $size * 0.4;
        $this->thickness = $thickness;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.loader');
    }
}