<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectChoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'subject_id',
        'layer_id',
    ];

    public function subject()
    {
        return $this->hasOne(Subject::class);
    }

    public function layer()
    {
        return $this->hasOne(Layer::class);
    }
}
