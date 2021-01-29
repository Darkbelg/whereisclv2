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

        return view('overview', ['events' => $events]);
    }
}
