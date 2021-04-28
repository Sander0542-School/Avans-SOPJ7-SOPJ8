<?php

namespace App\Http\Livewire;

use App\Models\Layer;
use Livewire\Component;

class LayerContent extends Component
{
    public $layerSlug;

    protected $listeners = [
        'layerChanged' => 'layerChanged'
    ];

    public function render()
    {
        $layer = Layer::firstWhere('slug', $this->layerSlug);
        $parentLayers = $this->getParentLayers($layer);
        $subjectId = 0;

        if (sizeof($parentLayers) > 0 && $parentLayers[0]->subject != null) {
            $subjectId = $parentLayers[0]->subject->id;
        } else if ($layer != null && $layer->subject != null) {
            $subjectId = $layer->subject->id;
        }

        return view('livewire.layer-content')
            ->with('layer', $layer)
            ->with('parentLayers', $parentLayers)
            ->with('subjectId', $subjectId);
    }

    public function layerChanged($layerSlug) {
        $this->layerSlug = $layerSlug;
    }

    private function getParentLayers($layer) {
        $parentLayers = [];

        if ($layer != null) {
            $parentLayer = $layer->parentLayer;
            while($parentLayer != null) {
                array_unshift($parentLayers, $parentLayer);
                $parentLayer = $parentLayer->parentLayer;
            }
        }

        return $parentLayers;
    }
}
