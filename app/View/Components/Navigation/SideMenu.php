<?php

namespace App\View\Components\Navigation;

use App\Models\Layer;
use App\Models\Subject;
use Cache;
use Illuminate\View\Component;
use Str;

class SideMenu extends Component
{
    public $menu;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->menu = $this->getMenu();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.navigation.side-menu');
    }

    private function getMenu()
    {
        $menu = Cache::get('sidemenu');

        if ($menu == null) {
            $menu = $this->buildMenu();

            Cache::put('sidemenu', $menu, 3600);
        }

        return $menu;
    }

    private function buildMenu()
    {
        $menu = [];

        foreach (Subject::all() as $subject) {
            $subMenu = [
                'name' => $subject->name,
                'slug' => Str::slug($subject->name),
                'children' => $this->getChildren($subject->layers),
            ];
            array_push($menu, $subMenu);
        }

        return $menu;
    }

    private function getChildren($layers)
    {
        if ($layers->count() <= 0) {
            return null;
        }

        $menu = [];

        /**
         * @var $layer Layer
         */
        foreach ($layers as $layer) {
            $subMenu = [
                'name' => $layer->name,
                'slug' => $layer->slug,
                'children' => $this->getChildren($layer->childLayers),
            ];
            array_push($menu, $subMenu);
        }

        return $menu;
    }
}
