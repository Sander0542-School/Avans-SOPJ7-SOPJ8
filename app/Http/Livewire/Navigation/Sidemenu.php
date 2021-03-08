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
                'children' => $this->getSubjectChildren($subject)
            ];

            array_push($menu, $subMenu);
        }

        return $menu;
    }

    private function getSubjectChildren(Subject $subject) {
        if ($subject->layers->count() <= 0) {
            return null;
        }

        $menu = [];

        foreach ($subject->layers as $layer) {
            $subMenu = [
                'name' => $layer->name,
                'children' => $this->getLayerChildren($layer)
            ];

            array_push($menu, $subMenu);
        }

        return $menu;
    }

    private function getLayerChildren(Layer $layer) {
        if ($layer->childLayers->count() <= 0) {
            return null;
        }

        $menu = [];

        foreach ($layer->childLayers as $layer) {
            $subMenu = [
                'name' => $layer->name,
                'children' => $this->getLayerChildren($layer)
            ];

            array_push($menu, $subMenu);
        }

        return $menu;
    }
}
