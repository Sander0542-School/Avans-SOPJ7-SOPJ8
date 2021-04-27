<?php

namespace App\Http\Livewire;

use App\Models\Layer;
use Livewire\Component;

class LayerContent extends Component
{
    public $layerSlug;
    public $subjectId;

    protected $listeners = [
        'layerChanged' => 'layerChanged'
    ];

    public function render()
    {
        $layer = Layer::firstWhere('slug', $this->layerSlug);

        return view('livewire.layer-content')
            ->with('layer', $layer)
            ->with('parentLayers', $this->getParentLayers($layer));
    }

    public function layerChanged($layerSlug) {
        $this->layerSlug = $layerSlug;
    }

    private function getParentLayers($layer) {
        $parentLayers = [];

        if ($layer != null) {
            $parentLayer = $layer->parentLayer;
            while($parentLayer != null) {
                $this->subjectId = $parentLayer->id;
                array_unshift($parentLayers, $parentLayer);
                $parentLayer = $parentLayer->parentLayer;
            }
        }

        return $parentLayers;
    }
}
