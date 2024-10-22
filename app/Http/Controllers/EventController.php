<?php

namespace App\Http\Controllers;

use App\Exports\ExportEvent;
use App\Jobs\EventMailJob;
use App\Exports\ExportGroupSemmester;
use App\Models\EventSwin;
use App\Models\StudentEvent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Maatwebsite\Excel\Facades\Excel;
use MongoDB\Driver\Session;

class EventController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $events = EventSwin::orderBy('id', 'asc')->get();
        return view('admin.events.index', compact('events'));
    }

    public function listStudent()
    {
        $studentList = User::where('user_level', 3)->select('user_code')->pluck('user_code')->toArray();
        return response()->json($studentList);
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
//        $request->validate([
//            'gold' => 'required',
//            'name_event' => 'required',
//            'start_date' => 'required',
//            'end_date' => 'required'
//        ]);
        $start_date =  Carbon::createFromFormat('Y/m/d H:i', $request->start_date)->format('Y-m-d H:i');
        $end_date =  Carbon::createFromFormat('Y/m/d H:i', $request->end_date)->format('Y-m-d H:i');
        $campus_db = session('campus_db');
        DB::connection($campus_db)->beginTransaction();

        try {
            $user_code = $request->user_login;
            $student_codes = "";
            if ($user_code) {
                $users = json_decode($user_code, true);

                // Kiểm tra nếu dữ liệu có nhiều value
                if (isset($users[0]['value']) && is_array($users) && count($users) > 1) {
                    // Trường hợp có nhiều value
                    $student_codes = array_column($users, 'value');
                } else {
                    // Trường hợp có một value
                    $student_codes = $users[0]['value'];
                    // Loại bỏ ký tự xuống dòng và dấu cách
                    $student_codes = str_replace(["\n", " "], "", $student_codes);
                    // Tách chuỗi thành các mã sinh viên riêng biệt bằng preg_split
                    $student_codes = preg_split('/(?=S)/', $student_codes, -1, PREG_SPLIT_NO_EMPTY);
                }
            }
            $event = new EventSwin();
            $add_event = $event->create([
                'department' => $request->department,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'name_event' => $request->name_event,
                'description_event' => $request->description_event,
                'gold' => $request->gold
            ]);
            $event_id = $add_event->id;
            $data = [];
            $date = Carbon::now()->toDateTimeString();
            if ($student_codes != "") {
                foreach ($student_codes as $user_code) {
                    $lecturer = User::where('user_code', $user_code)->first();
                    $full_name = $lecturer->user_surname . ' ' . $lecturer->user_middlename . ' ' . $lecturer->user_givenname;
                    $data[] = [
                        'user_code' => $user_code,
                        'full_name' => $full_name,
                        'event_id' => $event_id,
                        'date_add' => $date,
                        'level_member' => 1
                    ];
                }
                StudentEvent::insert($data);
            }
            DB::connection($campus_db)->commit();

            return redirect()->route('event.index')->with('msg-add', 'Create Event Successful');
        } catch (\Exception $e) {
            // Rollback transaction nếu có lỗi xảy ra
            DB::connection($campus_db)->rollback();
            throw $e;
        }
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
        $studentEvent = StudentEvent::where('event_id', $id)->where('level_member', '!=', 1)->get();
        $totalRelaties = StudentEvent::where('event_id', $id)->select('relatives')->sum('relatives');
        return view('admin.events.detail', compact('event', 'studentEvent', 'id', 'totalRelaties'));
    }

    public function deleteStudent(Request $request)
    {
        $id = $request->id;
        $student = StudentEvent::find($id);
        $student->delete();

        return response()->json(['msg_delete' => 'Delete Student Even Successful']);
    }

    public function studentAdd(Request $request)
    {
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
                        'full_name' => $user->user_surname . ' ' . $user->user_middlename . ' ' . $user->user_givenname,
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

    public function listLecturer()
    {
        $users = User::where('user_level', 2)->select('user_code')->pluck('user_code')->toArray();
        return response()->json($users);
    }

    public function exportEvents(Request $request)
    {
        $id = $request->id;
        $studentEvents = StudentEvent::where('event_id', $id)->select('user_code', 'full_name', 'event_id', 'relatives', 'gold')->get();
        $exports = new ExportEvent([$studentEvents]);

        return Excel::download($exports, 'events.xlsx');
    }

    public function eventUpdate(Request $request)
    {
        $user_code = $request->user_login;
        $users = json_decode($user_code);
        $event_id = $request->event_id;
        $gold = $request->gold;
        $date_now = Carbon::now()->toDateTimeString();
        $table = [];
        $output = "";
        foreach ($users as $item) {
            $eventArray = StudentEvent::where('event_id', $event_id)->select('user_code')->pluck('user_code')->toArray();
            $userStudent = User::where('user_code', $item->value)->first();
            $full_name = $userStudent->user_surname . ' ' . $userStudent->user_middlename . ' ' . $userStudent->user_givenname;

            if (in_array($item->value, $eventArray)) {
                return response()->json(['error_type' => "This $item->value has existed"]);
            } else {
                $table[] = [
                    'user_code' => $item->value,
                    'full_name' => $full_name,
                    'event_id' => $event_id,
                    'date_add' => $date_now,
                    'is_active' => 0,
                    'gold' => $gold,
                    'type_person' => 'member',
                    'relatives' => 0
                ];
            }
        }
        StudentEvent::insert($table);
        $userEvent = StudentEvent::where('event_id', $event_id)->orderBy('id', 'DESC')->get();
        $i = 1;
        foreach ($userEvent as $item) {
            $event_name = $item->events ? $item->events->name_event : "";
            $output .= '<tr>';
            $output .= '<td>' . $i++ . '</td>';
            $output .= '<td >' . $item->user_code . '</td>';
            $output .= '<td>' . $item->full_name . '</td>';
            $output .= '<td>' . $event_name . '</td>';
            $output .= '<td>' . $item->gold . '</td>';
            if ($item->is_active == 1) {
                $output .= '<td>';
                $output .= '<button type="button" class="btn btn-success btn-elevate btn-pill btn-elevate-air btn-sm">Attendance</button>';
                $output .= '</td>';
            } else {
                $output .= '<td>';
                $output .= '<button type="button" class="btn btn-warning btn-elevate btn-pill btn-elevate-air btn-sm">Warning</button>';
                $output .= '</td>';
            }
            $output .= '<td>';
            $output .= '<button type="button" class="btn" id="delete_event" data-id="' . $item->id . '" data-toggle="kt-tooltip" title="Delete"
                                            data-original-title="Close"><i class="flaticon-delete"></i></button>';
            $output .= '</tr>';
        }
        return $output;
    }

    public function eventHistory()
    {
        $eventHistory = StudentEvent::selectRaw('SUM(gold) as gold, full_name, user_code')
            ->orderBy('gold', 'desc')
            ->groupBy('user_code', 'full_name')
            ->get();
        return view('admin.events.history', compact('eventHistory'));
    }

    public function emailFee()
    {
        return view('admin.fees.email-fee');
    }

    public function sendMail()
    {
        $email = "thientam160796@gmail.com";
        $campus_code = session('campus_db');
        $queue_config = config("queue.connections.$campus_code");
        try {
            EventMailJob::dispatch($email, $campus_code)->onConnection($campus_code);
            return response()->json(['message' => 'Email đã được đưa vào hàng đợi để gửi!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
//        dispatch(new EventMailJob($email,$campus_code))->onConnection($campus_code)->onQueue($campus_code);
//        Mail::to($email)->queue(new SendEventMail());
//        $emailJob = (new EventMailJob($email, $campus_code))->delay(Carbon::now()->addSeconds(10));
//        $this->dispatch($emailJob);
        dd(321321);
    }
}
