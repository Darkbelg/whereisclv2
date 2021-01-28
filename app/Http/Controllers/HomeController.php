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
                ['videos' => function ($query) {
                    $query->orderBy('views', 'DESC');
                }]
            )
                ->orderBy('date', 'desc')
                ->get();
        });

        $views = [];
        foreach (array_reverse($events->toArray()) as $event) {
            $dates[] = "'" . $event["date"] . "'";
            $views[] = (array_sum($views) + array_sum(array_map(function($video){

                return $video['views'];
            },$event['videos'])));
            
        }
        $views = implode("','", $views);
        $dates = implode(",", $dates);

        return view('overview', ['events' => $events, 'views' => $views, 'dates' => $dates]);
    }
}
