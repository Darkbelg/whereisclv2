<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\WorldMapResource;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorldMapController extends Controller
{
    public function index()
    {
        $events = Event::select(
            'title','latitude','longitude'
        )->orderBy('date', 'asc')->get();

       return WorldMapResource::collection($events);
    }
}
