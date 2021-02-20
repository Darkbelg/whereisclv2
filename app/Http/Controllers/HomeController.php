<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function show()
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
                ->get();
        });

        $views = [];
        $points = [];
        foreach (array_reverse($events->toArray()) as $event) {
            foreach ($event["videos"] as $video) {
                $points[] = "'" . $event["date"] . "'," . $video["views"];
            }


        }
        $points = implode("],[", $points);
        return view('overview', ['events' => $events, 'points' => $points]);
    }
}
