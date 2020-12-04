<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'location',
        'latitude',
        'longitude'
    ];

    /**
     * Get the comments for the blog post.
     */
    public function videos()
    {
        return $this->belongsToMany('App\Models\Video','events_videos');
    }
}
