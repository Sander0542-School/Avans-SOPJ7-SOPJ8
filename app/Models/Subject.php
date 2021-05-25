<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain_id',
        'name',
        'description',
        'order',
        'lon',
        'lat',
    ];

    public function domain()
    {
        return $this->hasOne(Domain::class, 'id', 'domain_id');
    }

    public function layers() {
        return $this->hasManyThrough(Layer::class, SubjectChoice::class, 'subject_id', 'id', 'id', 'layer_id');
    }
}
