<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;


class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //Carbon::parse(gmdate("Y-m-d\TH:i:s",$this->date))->format('d/m/Y')
        return [
            'id' => $this->id,
            'title' => $this->title,
            'date' => ($this->date)->format('d/m/Y'),
            'location' => $this->location,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'videos' => VideoResource::collection($this->videos)
        ];
    }
}
