<?php

namespace App\Http\Controllers;

use App\Models\EventSwin;
use App\Models\StudentEvent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    public function index(Request $request)
    {
        $event = EventSwin::where('id', $request->id)->first();
        $student_event = StudentEvent::where('event_id', $request->id)->where('is_active', 1)->get();

        return view('admin.qr-code.index', compact('student_event', 'event'));
    }

    public function storeQrCode(Request $request)
    {
        $date = Carbon::now()->toDateTimeString();
        $user_code = $request->result;
        $event_id = $request->event_id;
        $student_event = StudentEvent::where('event_id', $event_id)
            ->where('user_code', $user_code)
            ->first();
        $output = "";
        if (isset($student_event)) {
            if ($student_event->is_active == 0) {
                $student_event->update([
                    "is_active" => 1,
                    "gold" => 10
                ]);
                $studentEvents = StudentEvent::where('event_id', $event_id)->where('is_active', 1)->get();
                $i = 1;
                foreach ($studentEvents as $item) {
                    $output .= '<tr>';
                    $event_name = $item->events ? $item->events->name_event : "";
                    $output .= '<td>' . $i++ . '</td>';
                    $output .= '<td>' . $item->user_code . '</td>';
                    $output .= '<td>' . $item->full_name . '</td>';
                    $output .= '<td>' . $event_name . '</td>';
                    $output .= '<td>' . $item->gold . '</td>';
                    if ($item->is_active == 1) {
                        $output .= '<td>';
                        $output .= '<button type="button" class="btn btn-success btn-elevate btn-pill btn-elevate-air btn-sm">Attendance</button>';
                        $output .= '</td>';
                    } else {
                        $output .= '<button type="button" class="btn btn-warning btn-elevate btn-pill btn-elevate-air btn-sm">Warning</button>';
                    }
                    $output .= '<td>' . $item->type_person . '</td>';
                    $output .= '</tr>';
                }
                return $output;
            } else {
                $user = User::where('user_code', $user_code)->where('user_level', 3)->first();
                $full_name = $user->user_surname . ' ' . $user->user_middlename . ' ' . $user->user_givenname;

                return response()->json(["error_type" => "Sinh viên <span class='text-warning font-weight-bold'> $full_name </span> đã điểm danh rồi"]);
            }
        } else {
            $user = User::where('user_code', $user_code)->where('user_level', 3)->first();
            if (!empty($user)) {
                $full_name = $user->user_surname . ' ' . $user->user_middlename . ' ' . $user->user_givenname;

                StudentEvent::create([
                    'user_code' => $user_code,
                    'full_name' => $full_name,
                    'event_id' => $event_id,
                    'date_add' => $date,
                    'is_active' => 1,
                    'gold' => 10,
                    'type_person' => "Guest"
                ]);
                $studentEvents = StudentEvent::where('event_id', $request->event_id)->where('is_active', 1)->get();
                $index = 1;
                foreach ($studentEvents as $item) {
                    $output .= '<tr>';
                    $event_name = $item->events ? $item->events->name_event : "";
                    $output .= '<td>' . $index++ . '</td>';
                    $output .= '<td>' . $item->user_code . '</td>';
                    $output .= '<td>' . $item->full_name . '</td>';
                    $output .= '<td>' . $event_name . '</td>';
                    $output .= '<td>' . $item->gold . '</td>';
                    if ($item->is_active == 1) {
                        $output .= '<td>';
                        $output .= '<button type="button" class="btn btn-success btn-elevate btn-pill btn-elevate-air btn-sm">Attendance</button>';
                        $output .= '</td>';
                    } else {
                        $output .= '<button type="button" class="btn btn-warning btn-elevate btn-pill btn-elevate-air btn-sm">Warning</button>';
                    }
                    $output .= '<td>';
                    $output .= '<button type="button" class="btn btn-warning btn-elevate btn-pill btn-elevate-air btn-sm">' . $item->type_person . '</button>';
                    $output .= '</td>';
                    $output .= '</tr>';
                }
                return $output;
            }
            return response()->json(["error_type" => "User <span class='text-warning font-weight-bold'> này không tồn tại </span>"]);
        }
    }
}
