<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $with = ['thumbnails', 'channel', 'tags'];

    protected $fillable = [
        'id',
        'title',
        'channel_id',
        'published_at',
        'description',
        'comments',
        'dislikes',
        'likes',
        'views'
    ];

    protected $dates=[
        'created_at',
        'updated_at',
        'published_at'
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

    public function thumbnails()
    {
        return $this->hasMany('App\Models\Thumbnail');
    }
    
    public function getThumbnail()
    {
        return $this->thumbnails()["medium"];
    }
}
