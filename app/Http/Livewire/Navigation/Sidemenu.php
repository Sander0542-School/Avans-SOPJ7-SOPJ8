<?php

namespace App\Http\Livewire\Navigation;

use App\Models\Layer;
use App\Models\Subject;
use Livewire\Component;

class Sidemenu extends Component
{
    public function render()
    {
        return view('livewire.navigation.sidemenu', [
            'menu' => $this->buildMenu(),
        ]);
    }

    private function buildMenu() {
        $menu = [];

        foreach (Subject::all() as $subject) {
            $subMenu = [
                'name' => $subject->name,
                'children' => $this->getChildren($subject->layers)
            ];

            array_push($menu, $subMenu);
        }

        return $menu;
    }

    private function getChildren($layers) {
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
                'children' => $this->getChildren($layer->childLayers)
            ];

            array_push($menu, $subMenu);
        }

        return $menu;
    }
}
