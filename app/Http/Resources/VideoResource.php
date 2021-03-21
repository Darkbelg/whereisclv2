<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //dd($this);
        return [
            'id' => $this->id,
            'channel_id' => $this->channel_id,
            'published_at' => $this->published_at,
            'title' => $this->title,
            'url' => "https://www.youtube.com/watch?v=" . $this->id,
            'views' => number_format($this->views,0,","," "),
            'thumbnails' => ThumbnailResource::collection($this->thumbnails)
        ];
    }
}
