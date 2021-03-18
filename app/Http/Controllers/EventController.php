<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventPostRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::All();
        return view('events.index', ["events" => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventPostRequest $request)
    {
        $event = Event::create([
            'title' => $request->title,
            'date' => $request->date,
            'location' => $request->location,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return redirect('/events/' . $event->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show', ["event" => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.update', ["event" => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Event $event, EventPostRequest $request)
    {
        $event->update([
            'title' => $request->title,
            'date' => $request->date,
            'location' => $request->location,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return redirect('/events/' . $event->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        try {
            $event->delete();

            return redirect('/events');
        } catch (\Exception $th) {
            return redirect('/events')->with('status',
                'Unable to delete Event. Make sure all videos have been deleted before deleting the event.');
        }
    }
}
