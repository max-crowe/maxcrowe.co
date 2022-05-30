<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Layout extends Component
{
    /**
     * Whether to initialize the header element with a background container.
     *
     * @var bool
     */
    public $withBackground;

    /**
     * Create a new component instance.
     *
     * @param bool $withBackground
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
        return view('components.layout');
    }
}
