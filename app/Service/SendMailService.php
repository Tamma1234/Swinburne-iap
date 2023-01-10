<?php

namespace App\Service;

use Illuminate\Support\Facades\Mail;

class SendMailService
{
    public function sendPaymentMail($start_time, $end_time,$room_name, $group_name,
                                    $description, $userLogin, $id, $area_name, $psubject_name, $date)
    {
        Mail::send('admin.rooms.send-mail', [
            'id' => $id,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'room_name' => $room_name,
            'group_name' => $group_name,
            'user_login' => $userLogin,
            'description' => $description,
            'area_name' => $area_name,
            'psubject_name' => $psubject_name,
            'date' => $date,
        ], function ($mail) use ($room_name) {
            $mail->from('thientamjvb@gmail.com');
            $mail->to('thientam160796@gmail.com');
            $mail->subject('Đặt phòng học cho sinh viên');
        });
    }

    public function confirmSendMail($start_at, $end_at, $date, $room_name, $area_name,
                                    $group_name, $psubject_name, $description, $id, $email) {
        Mail::send('admin.rooms.confirm-mail', [
            'id' => $id,
            'start_time' => $start_at,
            'end_time' => $end_at,
            'date' => $date,
            'room_name' => $room_name,
            'area_name' => $area_name,
            'group_name' => $group_name,
            'psubject_name' => $psubject_name,
            'description' => $description,
        ], function ($mail) use ($email) {
            $mail->from('thientamjvb@gmail.com');
            $mail->to($email);
            $mail->subject('Đặt phòng học cho sinh viên');
        });
    }

    public function cancelSendMail($room_name, $descriptionCancel, $email) {
        Mail::send('admin.rooms.cancel-mail', [
            'room_name' => $room_name,
            'noi_dung' => $descriptionCancel,
        ], function ($mail) use ($email) {
            $mail->from('thientamjvb@gmail.com');
            $mail->to($email);
            $mail->subject('Đặt phòng học cho sinh viên');
        });
    }
}
