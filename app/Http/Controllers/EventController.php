<?php

namespace App\Http\Controllers;

use App\Models\EventSwin;
use App\Models\StudentEvent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $events = EventSwin::all();
        return view('admin.events.index', compact('events'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'gold' => 'required'
        ]);
        $event = new EventSwin();
        $event->create([
            'department' => $request->department,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'name_event' => $request->name_event,
            'description_event' => $request->description_event,
            'gold' => $request->gold
        ]);

        return redirect()->route('event.index')->with('msg-add', 'Create Event Successful');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        $event = EventSwin::find($id);
        $event->delete();

        return redirect()->route('event.index')->with('msg-add', 'Delete Event Successful');
    }

    public function detail(Request $request)
    {
        $id = $request->id;
        $event = EventSwin::find($id);
        $studentEvent = StudentEvent::where('event_id', $id)->get();
        return view('admin.events.detail', compact('event', 'studentEvent', 'id'));
    }

    public function deleteStudent(Request $request)
    {
        $id = $request->id;
        $student = StudentEvent::find($id);
        $student->delete();

        return response()->json(['msg_delete' => 'Delete Student Even Successful']);
    }

    public function studentAdd(Request $request) {
        $data = $request->all();
        $userArray = explode(',', $data['user_name']);
        $date = Carbon::now()->toDateTimeString();
        $event = StudentEvent::where('event_id', $data['event_id'])->select('user_code')->pluck('user_code')->toArray();
        if (empty(array_intersect($userArray, $event))) {

        }
        $stdentEvent = [];
        foreach ($userArray as $item) {
            if (in_array($item, $event)) {
                return response()->json(['error_type' => "This $item has existed"]);
            } else {
                $user = User::where('user_code', $item)->first();
                if ($user) {
                    $stdentEvent[] = [
                        'user_code' => $item,
                        'full_name' => $user->user_surname .' '. $user->user_middlename .' '. $user->user_givenname,
                        'event_id' => $data['event_id'],
                        'date_add' => $date
                    ];
                } else {
                    return response()->json(['error_type' => "Student ID does not exist in user"]);
                }
            }
        }
        StudentEvent::insert($stdentEvent);
        return response()->json(['success' => "Create Student In Event Successful"]);
    }
}
