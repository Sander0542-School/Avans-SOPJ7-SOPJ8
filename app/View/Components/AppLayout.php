<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public $hasContainer;

    public $bodyClasses;

    public $mainClasses;

    /**
     * AppLayout constructor.
     *
     * @param bool $hasContainer
     */
    public function __construct(bool $hasContainer = true, $bodyClasses = '', $mainClasses = '')
    {
        $this->hasContainer = $hasContainer;
        $this->bodyClasses = $bodyClasses;
        $this->mainClasses = $mainClasses;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $mainClasses = explode(' ', $this->mainClasses);

        if ($this->hasContainer) {
            $mainClasses[] = 'container';
            $mainClasses[] = 'my-5';
        }

        return view('layouts.app')
            ->with('mainClasses', implode(' ', $mainClasses))
            ->with('bodyClasses', $this->bodyClasses);
    }
}
