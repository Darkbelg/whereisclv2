<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class EventController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $events = Cache::rememberForever('events', function () {
            return Event::with(
                [
                    'videos' => function ($query) {
                        $query->orderBy('views', 'DESC');
                    }
                ]
            )
                ->orderBy('date', 'desc')
                ->paginate(3);
        });
        return EventResource::collection($events);
    }
}
