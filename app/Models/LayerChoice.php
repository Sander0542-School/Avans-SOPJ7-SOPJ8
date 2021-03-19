<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayerChoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_layer_id',
        'child_layer_id',
    ];

    public function parentLayer()
    {
        return $this->hasOne(Layer::class, 'id', 'parent_layer_id');
    }

    public function childLayer()
    {
        return $this->hasOne(Layer::class, 'id', 'child_layer_id');
    }
}
