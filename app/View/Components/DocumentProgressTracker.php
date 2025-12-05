<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DocumentProgressTracker extends Component
{
    public $layers;
    /**
     * Create a new component instance.
     */
    public function __construct($layers = [])
    {
        $this->layers = $layers;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.document-progress-tracker');
    }
}
