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

    protected $dates = [
        'created_at',
        'updated_at',
        'published_at'
    ];


    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'tags_videos');
    }

    public function channel()
    {
        return $this->belongsTo('App\Models\Channel');
    }

    public function events()
    {
        return $this->belongsToMany('App\Models\Event', 'events_videos');
    }

    public function thumbnails()
    {
        return $this->hasMany('App\Models\Thumbnail');
    }

    public function getThumbnail()
    {
        return $this->thumbnails()["medium"];
    }

    public function updateTags($newTags)
    {
        $videoTags = $this->tags()->get()->toArray();
        $diffTags = array_diff(array_map(function ($value) {
            return $value["tag"];
        }, $videoTags), (array)$newTags);

        foreach ($diffTags as $id => $tag) {
            $this->tags()->detach(Tag::where('tag', $tag)->first()->id);
        }

        foreach ((array)$newTags as $tag) {
            $this->tags()->firstOrCreate([
                "tag" => $tag
            ]);
        }
        return $this;
    }

    public function updateThumbnails($newThumbnails)
    {
        foreach ($newThumbnails as $size => $thumbnail) {
            $this->thumbnails()->updateOrCreate([
                'size' => $size,
                'url' => $thumbnail["url"],
                'height' => $thumbnail["height"],
                'width' => $thumbnail["width"]
            ]);
        }
        return $this;
    }

    public function detach()
    {
        $this->tags()->detach();
        $this->events()->detach();
        $this->thumbnails()->delete();
    }
}
