<?php

namespace App\Http\Controllers;

use App\Models\StudentEvent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    public function index()
    {
        $student_event = StudentEvent::where('event_id', 22)->get();
        return view('admin.qr-code.index', compact('student_event'));
    }

    public function storeQrCode(Request $request)
    {
        $date = Carbon::now()->toDateTimeString();
        $user_code = $request->result;
        $student_event = StudentEvent::where('event_id', 22)->select('user_code')->pluck('user_code')->toArray();
        if (!in_array($user_code, $student_event)) {
            $user = User::where('user_code', $user_code)->where('user_level', 3)->first();
            $full_name = $user->user_surname . ' ' . $user->user_middlename . ' ' . $user->user_givenname;
            StudentEvent::create([
                'user_code' => $user_code,
                'full_name' => $full_name,
                'event_id' => 22,
                'date_add' => $date,
                'is_active' => 1
            ]);
            $studentEvents = StudentEvent::where('event_id', 22)->get();
            $output = "";
            $i = 1;
            foreach ($studentEvents as $item) {
                $output .= '<tr>';
                $event_name = $item->events ? $item->events->name_event : "";
                $output .= '<td>' . $i++ . '</td>';
                $output .= '<td>' . $item->user_code . '</td>';
                $output .= '<td>' . $item->full_name . '</td>';
                $output .= '<td>' . $event_name . '</td>';
                if ($item->is_active == 1) {
                    $output .= '<td>';
                    $output .= '<button type="button" class="btn btn-success btn-elevate btn-pill btn-elevate-air btn-sm">Attendance</button>';
                    $output .= '</td>';
                } else {
                    $output .= '<button type="button" class="btn btn-warning btn-elevate btn-pill btn-elevate-air btn-sm">Warning</button>';
                }
                $output .= '</tr>';
            }
            return $output;
        } else {
            return false;
        }
    }
}
