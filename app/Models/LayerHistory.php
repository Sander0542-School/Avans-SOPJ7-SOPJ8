<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayerHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'layer_id',
        'user_id',
        'action',
        'name',
        'slug',
        'content',
    ];

    public function layer()
    {
        return $this->belongsTo(Layer::class, 'layer_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
