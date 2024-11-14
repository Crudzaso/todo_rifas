<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BettingResults extends Component
{

    public $winners;

    /**
     * Create a new component instance.
     */
    public function __construct($winners)
    {
        $this->winners = $winners;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.betting-results');
    }
}
