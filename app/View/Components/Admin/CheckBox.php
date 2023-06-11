<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CheckBox extends Component
{
    public $label;
    public $name;
    public $class;
    /**
     * Create a new component instance.
     */
    public function __construct($label, $name, $class="")
    {
        $this->label = $label;
        $this->name = $name;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.check-box');
    }
}