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
        if (Cache::has('sidemenu')) {
            $ttl = config('app.debug', false) ? 3600 : null; // 1 hour if debug, else forever
            Cache::put('sidemenu', $this->buildMenu(), $ttl);
        }

        return Cache::get('sidemenu');
    }

    private function buildMenu()
    {
        $menu = [];

        foreach (Subject::orderBy('order')->get() as $subject) {
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
