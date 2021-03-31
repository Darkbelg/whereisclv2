<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(
                [
                    'videos' => function ($query) {
                        $query->orderBy('views', 'DESC');
                    }
                ]
            )
                ->orderBy('date', 'desc')
                ->paginate(3);
        return EventResource::collection($events);
    }
}
