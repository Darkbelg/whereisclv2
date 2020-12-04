<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'title',
        'channel_id',
        'description',
        'comments',
        'dislikes',
        'likes',
        'views'
    ];


    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag','tags_videos');
    }

    public function channel()
    {
        return $this->belongsTo('App\Models\Channel');
    }

    public function events()
    {
        return $this->belongsToMany('App\Models\Event','events_videos');
    }
}
