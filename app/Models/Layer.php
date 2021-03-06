<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Layer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'content',
    ];

    public function subject()
    {
        return $this->hasOneThrough(Subject::class, SubjectChoice::class, 'layer_id', 'id', 'id', 'subject_id');
    }

    public function childLayers()
    {
        return $this->hasManyThrough(Layer::class, LayerChoice::class, 'parent_layer_id', 'id', 'id', 'child_layer_id');
    }

    public function parentLayer()
    {
        return $this->hasOneThrough(Layer::class, LayerChoice::class, 'child_layer_id', 'id', 'id', 'parent_layer_id');
    }

    public function history()
    {
        $this->hasMany(LayerHistory::class, 'layer_id', 'id');
    }
}
