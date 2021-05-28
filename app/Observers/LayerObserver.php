<?php

namespace App\Observers;

use App\Models\Layer;
use Spatie\Permission\Models\Permission;

class LayerObserver
{
    /**
     * Handle the Layer "created" event.
     *
     * @param  \App\Models\Layer  $layer
     * @return void
     */
    public function created(Layer $layer)
    {
        Permission::create(['name' => 'layers.*.'.$layer->id]);
        Permission::create(['name' => 'layers.update.'.$layer->id]);
        Permission::create(['name' => 'layers.delete.'.$layer->id]);
    }

    /**
     * Handle the Layer "updated" event.
     *
     * @param  \App\Models\Layer  $layer
     * @return void
     */
    public function updated(Layer $layer)
    {
        //
    }

    /**
     * Handle the Layer "deleted" event.
     *
     * @param  \App\Models\Layer  $layer
     * @return void
     */
    public function deleted(Layer $layer)
    {
        //
    }

    /**
     * Handle the Layer "restored" event.
     *
     * @param  \App\Models\Layer  $layer
     * @return void
     */
    public function restored(Layer $layer)
    {
        //
    }

    /**
     * Handle the Layer "force deleted" event.
     *
     * @param  \App\Models\Layer  $layer
     * @return void
     */
    public function forceDeleted(Layer $layer)
    {
        //
    }
}
