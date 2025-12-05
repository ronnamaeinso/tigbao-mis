<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputGroup extends Component
{
    /**
     * Create a new component instance.
     */
    public $name, $labelName, $type, $placeholder, $isRequired, $addons, $tailIcon, $labelIcon, $value;
    public function __construct($name = '', $labelName = '', $type = 'text', $placeholder = '', $isRequired = true, $addons = '', $tailIcon = '', $labelIcon = '', $value = '')
    {
        $this->name = $name;
        $this->labelName = $labelName;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->isRequired = $isRequired;
        $this->addons = $addons;
        $this->tailIcon = $tailIcon;
        $this->labelIcon = $labelIcon;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-group');
    }
}
