<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Thumbnail
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $video_id
 * @property string $size
 * @property string $url
 * @property int $width
 * @property int $height
 * @property-read \App\Models\Video $video
 * @method static \Illuminate\Database\Eloquent\Builder|Thumbnail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Thumbnail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Thumbnail query()
 * @method static \Illuminate\Database\Eloquent\Builder|Thumbnail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thumbnail whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thumbnail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thumbnail whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thumbnail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thumbnail whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thumbnail whereVideoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Thumbnail whereWidth($value)
 * @mixin \Eloquent
 */
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
