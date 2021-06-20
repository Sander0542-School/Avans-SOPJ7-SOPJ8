<?php

namespace App\Observers;

use App\Common\Traits\PermissionsTrait;
use App\Models\Layer;
use App\Models\LayerHistory;

class LayerObserver
{
    use PermissionsTrait;

    /**
     * Handle the Layer "created" event.
     *
     * @param \App\Models\Layer $layer
     * @return void
     */
    public function created(Layer $layer)
    {
        $this->createPermissions('layers', $layer->id);
    }

    /**
     * Handle the Layer "updated" event.
     *
     * @param \App\Models\Layer $layer
     * @return void
     */
    public function updated(Layer $layer)
    {
        LayerHistory::create([
            'layer_id' => $layer->id,
            'action' => 'updated',
            'name' => $layer->name,
            'slug' => $layer->slug,
            'content' => $layer->content,
        ]);
    }

    /**
     * Handle the Layer "deleted" event.
     *
     * @param \App\Models\Layer $layer
     * @return void
     */
    public function deleted(Layer $layer)
    {
        LayerHistory::create([
            'layer_id' => $layer->id,
            'action' => 'deleted',
            'name' => $layer->name,
            'slug' => $layer->slug,
            'content' => $layer->content,
        ]);
    }

    /**
     * Handle the Layer "restored" event.
     *
     * @param \App\Models\Layer $layer
     * @return void
     */
    public function restored(Layer $layer)
    {
        LayerHistory::create([
            'layer_id' => $layer->id,
            'action' => 'restored',
            'name' => $layer->name,
            'slug' => $layer->slug,
            'content' => $layer->content,
        ]);
    }

    /**
     * Handle the Layer "force deleted" event.
     *
     * @param \App\Models\Layer $layer
     * @return void
     */
    public function forceDeleted(Layer $layer)
    {
        LayerHistory::create([
            'layer_id' => $layer->id,
            'action' => 'deleted',
            'name' => $layer->name,
            'slug' => $layer->slug,
            'content' => $layer->content,
        ]);
    }
}
