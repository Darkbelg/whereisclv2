<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thumbnail extends Model
{
    use HasFactory;

    protected $fillable = [
        'size',
        'url',
        'height',
        'width'
    ];


    public function video()
    {
        return $this->belongsTo('App\Models\Video');
    }
}
