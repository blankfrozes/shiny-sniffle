<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectBox extends Component
{
    public $label;
    public $placeholder;
    public $name;
    public $options;
    public $class;
    public $disabled;
    /**
     * Create a new component instance.
     */
    public function __construct($label = "", $placeholder = null, $name, $options = [], $class = "", $disabled = false)
    {
        $this->placeholder = $placeholder ?? ' -- select an option -- ';
        $this->options = $options;
        $this->label = $label;
        $this->name = $name;
        $this->class = $class;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.select-box');
    }
}