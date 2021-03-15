<?php

namespace App\View\Components\Navigation;

use Illuminate\View\Component;

class SideMenuItem extends Component
{
    public $menuItem;

    public $firstLayer = false;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($menuItem, $firstLayer = false)
    {
        $this->menuItem = $menuItem;
        $this->firstLayer = $firstLayer;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.navigation.side-menu-item');
    }
}
