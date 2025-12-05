<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     */
    public $name, $labelName, $isRequired, $addons, $labelIcon;
    public function __construct($name = '', $labelName = '', $isRequired = true, $addons = '', $labelIcon = '')
    {
        $this->name = $name;
        $this->labelName = $labelName;
        $this->isRequired = $isRequired;
        $this->addons = $addons;
        $this->labelIcon = $labelIcon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}
