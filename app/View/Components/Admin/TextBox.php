<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextBox extends Component
{
    public $label;
    public $placeholder;
    public $name;
    public $class;
    public $type;
    public $disabled;
    public $debounced;
    /**
     * Create a new component instance.
     */
    public function __construct($name, $label, $placeholder = '', $class = "", $type = "text", $disabled = false, $debounced = false)
    {
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->type = $type;
        $this->class = $class;
        $this->disabled = $disabled;
        $this->debounced = $debounced;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.text-box');
    }
}
