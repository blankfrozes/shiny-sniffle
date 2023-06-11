<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputDate extends Component
{
    public $label;

    public $name;

    public $class;

    public $value;

    public $placeholder;
    /**
     * Create a new component instance.
     */
    public function __construct($label, $name, $class = '', $placeholder = '')
    {
        $this->label = $label;
        $this->name = $name;
        $this->class = $class;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.input-date');
    }
}