<?php

namespace App\Http\Controllers;

use App\Models\Fu\Activitys;
use App\Models\Fu\Areas;
use App\Models\Fu\Bookrooms;
use App\Models\Fu\Campus;
use App\Models\Fu\Groups;
use App\Models\Fu\Room;
use App\Models\Fu\RoomType;
use App\Models\Fu\Slot;
use App\Models\Fu\Subjects;
use App\Models\Product;
use App\Models\User;
use App\Service\Service;
use Carbon\Carbon;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $activity = new Activitys();
//        $activity = Bookrooms::whereRaw("id NOT IN (SELECT id FROM fu_activity)")->get();
//        $bookRoom = Activitys::select('id')
//        ->whereNotIn('id', $activitys)
//            ->get();
        $rooms = Room::orderBy('id', 'asc')->get();
        $slots = Slot::all();
        $subjects = Subjects::all();
        $groups = Groups::all();
        $bookRooms = new Bookrooms();

        if (isset($_GET['date'])) {
            $today = $_GET['date'];
            $format = date('Y-m-d', strtotime($today));

            return view('admin.rooms.list', compact('rooms', 'slots', 'activity',
                'format', 'today', 'subjects', 'groups', 'bookRooms'));
        } else {
            $format = Carbon::now()->toDateString();
            $today = date('m/d/Y', strtotime($format));
            return view('admin.rooms.list', compact('rooms', 'slots', 'activity',
                'format', 'today', 'subjects', 'groups', 'bookRooms'));
        }
//        foreach ($rooms as $room) {
//            $temp = $activitys->where('room_id', $key);
//            foreach ($temp as $item)
//            {
//                $data[$item->slot] = (object) [
//                    'session_description' => $item->session_description,
//                    'group_name' => $item->group_name,
//                    'leader_login' => $item->leader_login,
//                    'subject_code' => $item->psubject_code,
//                    'attendance' => $item->done,
//                ];
//            }
//            $rooms_temp[$key] = (object) [
//                'room_name' => $room,
//                'room_detail' => (object) $slot_have_activity,
//            ];
//        }
//        return view('admin.rooms.list', compact('rooms', 'slots', 'activitys',
//            'format', 'today', 'subjects', 'groups'));
    }

    /**
     * @return void
     */
    public function listRooms () {
        $rooms = Room::all();
        return view('admin.rooms.get-room', compact('rooms'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createRooms() {
        $room_type = RoomType::all();
        $areas = Areas::all();
        return view('admin.rooms.create', compact('room_type', 'areas'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function store(Request $request) {
        $room = new Room();
        $room->create([
            "area_id" => $request->area_id,
            "room_name" => $request->room_name,
            "room_type" => $request->room_type,
            "capacity" => $request->capacity,
            "valid_from" => $request->valid_from,
            "is_deleted" => 0
        ]);

        return redirect()->route('list.rooms')->with('msg-update', 'Create success room');
    }

    public function deleteRoom(Request $request) {
        $id = $request->id;
        $room = Room::find($id);
        $room->delete();

        return redirect()->route('list.rooms')->with('msg-delete', 'Delete success room');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function searchDate(Request $request)
    {
        $valueDate = $request->date;
        $format = date('Y-m-d', strtotime($valueDate));
        $rooms = Room::all();
        $slots = Slot::all();
        $subjects = Subjects::all();
        $groups = Groups::all();
        $activitys = new Bookrooms();

        return view('admin.rooms.search-date', compact('rooms', 'slots',
            'activitys', 'format', 'valueDate', 'subjects', 'groups'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addRooms(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_at' => 'required',
            'end_at' => 'required',
            'description' => 'required'
        ]);

        if ($validator->passes()) {
            $date = date('Y-m-d', strtotime($request->date));
            $start_at = strtotime($request->start_at);
            $start_time = date("H:i:s", $start_at);
            $end_at = strtotime($request->end_at);
            $end_time = date("H:i:s", $end_at);
            $userLogin = auth()->user()->user_login;

            if ($start_time == $end_time || $start_time > $end_time) {
                return response()->json(['errorType' => "wrong booking time"]);
            }
            $room_name = $request->room_name;
            $groupId = $request->groupId;
            $description = $request->description;
            $area_id = $request->area_id;
            $psubject_id = $request->psubject_id;
            $activitys = Bookrooms::where('day', $date)
                ->where('room_id', $request->id)
                ->select('start_at', 'end_at')
                ->get();
            $create = "";
            if (count($activitys) > 0) {
                foreach ($activitys as $activity) {
                    if ($start_time <= $activity->start_at && $activity->start_at < $end_time) {
                        return response()->json(['errorTime' => "Choose the wrong time"]);
                    } elseif ($start_time >= $activity->start_at && $start_time < $activity->end_at) {
                        return response()->json(['errorTime' => "Choose the wrong time"]);
                    } elseif ($start_time < $activity->end_at && $end_time > $activity->end_at) {
                        return response()->json(['errorTime' => "Choose the wrong time"]);
                    } else {
                        $create = [
                            'day' => $date,
                            'room_id' => $request->id,
                            'leader_login' => $userLogin,
                            'term_id' => 1,
                            'groupid' => $groupId,
                            'course_id' => 1,
                            'psubject_id' => $psubject_id,
                            'session_type' => 1,
                            'psyllabus_id' => 1,
                            'area_id' => $area_id,
                            'session_check' => 0,
                            'room_name' => $request->room_name,
                            'description' => $request->description,
                            'start_at' => $start_time,
                            'end_at' => $end_time,
                            'des_cancel_room' => "",
                        ];
                    }
                }
                $id = Activitys::create($create)->id;
                $bookRoom = Activitys::find($id);
                $psubject_id = Activitys::find($id)->psubject_id;
                $group_id = Activitys::find($id)->groupid;
                $area_name = $bookRoom->areas ? $bookRoom->areas->area_name : "";

                if ($psubject_id != null && $group_id != null) {
                    $psubject_name = Subjects::find($psubject_id)->subject_name;
                    $groupName = Groups::find($group_id)->group_name;
//                    Service::getSendMail()->sendPaymentMail($start_time, $end_time, $room_name,
//                        $groupName, $description, $userLogin, $id, $area_name, $psubject_name, $date);

                    return response()->json(['success' => "Booking successful"]);
                } else {
                    $psubject_name = "";
                    $groupName = "";
//                    Service::getSendMail()->sendPaymentMail($start_time, $end_time, $room_name,
//                        $groupName, $description, $userLogin, $id, $area_name, $psubject_name, $date);

                    return response()->json(['success' => "Booking successful"]);
                }

            } else {
                $create = [
                    'day' => $date,
                    'room_id' => $request->id,
                    'leader_login' => $userLogin,
                    'term_id' => 1,
                    'groupid' => $groupId,
                    'course_id' => 1,
                    'psubject_id' => $psubject_id,
                    'session_type' => 1,
                    'psyllabus_id' => 1,
                    'area_id' => $area_id,
                    'session_check' => 0,
                    'is_active' => 1,
                    'room_name' => $request->room_name,
                    'description' => $request->description,
                    'start_at' => $start_time,
                    'end_at' => $end_time,
                    'des_cancel_room' => ""
                ];

                $id = Activitys::create($create)->id;
                $bookRoom = Activitys::find($id);
                $psubject_id = Activitys::find($id)->psubject_id;
                $group_id = Activitys::find($id)->groupid;
                $area_name = $bookRoom->areas ? $bookRoom->areas->area_name : "";

                if ($psubject_id != null && $group_id != null) {
                    $psubject_name = Subjects::find($psubject_id)->subject_name;
                    $groupName = Groups::find($group_id)->group_name;
//                    Service::getSendMail()->sendPaymentMail($start_time, $end_time, $room_name,
//                        $groupName, $description, $userLogin, $id, $area_name, $psubject_name, $date);
                    return response()->json(['success' => "Booking successful"]);
                } else {
                    $psubject_name = "";
                    $groupName = "";
//                    Service::getSendMail()->sendPaymentMail($start_time, $end_time, $room_name,
//                        $groupName, $description, $userLogin, $id, $area_name, $psubject_name, $date);
                    return response()->json(['success' => "Booking successful"]);
                }
            }
        } else {
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function activeRooms(Request $request)
    {
        $activity = Activitys::find($request->id);
        $user = auth()->user();

        return view('admin.rooms.detail', compact('activity', 'user'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateRooms(Request $request)
    {
        $activity = Activitys::find($request->id);
        $id = $request->id;
        $user = User::where('user_login', $activity->leader_login)->first();
        $email = $user->user_email;
        $room_name = $activity->room_name;
        $date = $activity->day;
        $area_name = $activity->areas ? $activity->areas->area_name : "";
        $group_name = $activity->group_name;
        $psubject_name = $activity->psubject_name;
        $description = $activity->description;
        $start_at = $activity->start_at;
        $end_at = $activity->end_at;

        if ($activity->is_active == 1) {
            $activity->is_active = 0;
            $activity->save();
            Service::getSendMail()->confirmSendMail($start_at, $end_at, $date, $room_name, $area_name,
                $group_name, $psubject_name, $description, $id, $email);
            return redirect()->route('rooms.index')->with('msg-update', 'You have successfully approved the booking');
        } else {
            return redirect()->route('rooms.index')->with('errors', 'Approved room');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function cancelRooms(Request $request)
    {
        $id = $request->id;
        return view('admin.rooms.cancel', compact('id'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCancel(Request $request)
    {
        $activity = Activitys::find($request->id);
        $user = User::where('user_login', $activity->leader_login)->first();
        $email = $user->user_email;
        $activity->des_cancel_room = $request->des_cancel_room;
        $activity->is_active = 2;
        $activity->save();

        $room_name = $activity->room_name;
        $descriptionCancel = $activity->des_cancel_room;
        Service::getSendMail()->cancelSendMail($room_name, $descriptionCancel, $email);

        return redirect()->route('rooms.index')->with('msg-update', 'Canceled booking request successfully');
    }
}
