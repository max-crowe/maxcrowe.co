<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GlobalHeader extends Component
{
    /**
     * Whether to include the background container.
     *
     * @var bool
     */
    public $withBackground;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($withBackground = false)
    {
        $this->withBackground = (bool)$withBackground;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('components.global-header');
    }
}
