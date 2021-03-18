<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Video
 *
 * @property string $id
 * @property string $channel_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property string $title
 * @property string $description
 * @property int $comments
 * @property int $dislikes
 * @property int $likes
 * @property int $views
 * @property-read \App\Models\Channel $channel
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 * @property-read int|null $events_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Thumbnail[] $thumbnails
 * @property-read int|null $thumbnails_count
 * @method static \Illuminate\Database\Eloquent\Builder|Video newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Video newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Video query()
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereChannelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereDislikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereViews($value)
 * @mixin \Eloquent
 */
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
