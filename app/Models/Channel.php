<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'title'
    ];

    /**
     * Get the comments for the blog post.
     */
    public function videos()
    {
        return $this->hasMany('App\Models\Video');
    }
}
