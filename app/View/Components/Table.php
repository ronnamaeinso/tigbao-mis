<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    /**
     * Create a new component instance.
     */
    public $tableClass, $ths, $tableId;

    public function __construct($tableClass = '', $tableId = '', $ths = [])
    {
        $this->tableClass = $tableClass;
        $this->tableId = $tableId;
        $this->ths = $ths;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table');
    }
}
