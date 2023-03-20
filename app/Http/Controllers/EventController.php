<?php

namespace App\Http\Controllers;

use App\Models\EventSwin;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        $events = EventSwin::all();
        return view('admin.events.index', compact('events'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create() {
        return view('admin.events.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $event = new EventSwin();
        $event->create([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'name_event' => $request->name_event,
            'description_event' => $request->description_event,
            'phong_ban' => $request->phong_ban
        ]);

        return redirect()->route('event.index')->with('msg-add', 'Create Event Successful');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request) {
        $id = $request->id;
        $event = EventSwin::find($id);
        $event->delete();

        return redirect()->route('event.index')->with('msg-add', 'Delete Event Successful');
    }
}
