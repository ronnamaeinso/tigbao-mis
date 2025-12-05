<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectInputGroup extends Component
{
    /**
     * Create a new component instance.
     */
    public $name, $labelName, $type, $placeholder, $isRequired, $addons, $tailIcon, $labelIcon;
    public function __construct($name = '', $labelName = '', $isRequired = true, $addons = '', $tailIcon = '', $labelIcon = '')
    {
        $this->name = $name;
        $this->labelName = $labelName;
        $this->isRequired = $isRequired;
        $this->addons = $addons;
        $this->tailIcon = $tailIcon;
        $this->labelIcon = $labelIcon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-input-group');
    }
}
