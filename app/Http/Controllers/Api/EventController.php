<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class EventController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $currentPage = $request->get('page', 1);

        $events = Cache::rememberForever('events-' . $currentPage, function () {
            return Event::with(
                [
                    'videos' => function ($query) {
                        $query->without('tags')
                            ->without('channel')
                            ->with([
                                'thumbnails' => function ($query) {
                                    $query->where('size','high');
                                }
                            ])
                            ->orderBy('views', 'DESC');
                    }
                ]
            )
                ->orderBy('date', 'desc')
                ->simplePaginate(3);
        });
        return EventResource::collection($events);
    }
}
