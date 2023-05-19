<?php

namespace App\Service;

use App\Models\Fu\Acitivitys;
use App\Models\Fu\Groups;
use App\Models\Fu\Room;
use App\Models\Fu\Terms;
use Illuminate\Support\Facades\Mail;

class GroupService
{
    public function checkGroupName($group)
    {
        $term = Terms::select('id', 'term_name')->pluck('id', 'term_name')->toArray();
        $listTerm = array_change_key_case($term, CASE_UPPER);
        $result = [];
        foreach ($group as $key => $item) {
            $term = trim($item['term']);
            $date = trim($item['date']);
            $start_time = trim($item['start_time']);
            $end_time = trim($item['end_time']);
            $room = trim(strtoupper($item['room']));
            $teacher_login = trim($item['teacher_login']);
            $subject_code = trim($item['subject_code']);
            $course_session = trim($item['course_session']);
            $group_name = trim($item['group_name']);
            $term_id = $this->checkTermId($term, $listTerm);

            $checkGroupName = Groups::where('pterm_name', $term)
                ->where('group_name', $group_name)->select('group_name')
                ->first();
            $list_room = Room::select('id', 'room_name')->pluck('id', 'room_name')->toArray();

            if (empty($term_id)) {
                $result[] = "Không tìm thấy" . $term . "Trong danh sách học kỳ";
                continue;
            }
            if (!$this->checkDateImport($date)) {
                $result[] = $date . ' ' . "Không đúng định dạng";
                continue;
            }
            if (!$this->validateTime($start_time, $end_time)) {
                $result[] = "Thời gian giờ, phút, giây phải thuộc 2 kí tự";
                continue;
            }
            //Get RoomId && check có tồn tại không
            $room_id = $this->getKeyRoomId($room, $list_room);
            if (empty($room_id)) {
                $result[] = "Không tìm thấy phòng" . $room . "trong danh sách phòng";
            }
            if (!$this->checkTeacherFreeOn($teacher_login, $date, $start_time, $end_time)) {
                $result[] = "Giảng viên" .$teacher_login. "Đã bận vào ca này";
                continue;
            }
            if (!$this->validateCourseSession($course_session)) {
                $result[] = "Ca học phải là 1 số tự nhiên từ 1 đến 7";
            }

            if ($checkGroupName != null) {
                $result[] = "Group Name" . ' ' . $checkGroupName->group_name . ' ' . 'Đã tồn tại trong danh sách group';
                continue;
            }
        }
    }

    public function checkDateImport($date)
    {
        $intDate = strtotime($date);
        $dateFormat = date('Y-m-d', $intDate);
        $arrayDate = explode('-', $dateFormat);
        if (count($arrayDate) != 3) {
            return fales;
        }
        $year = $arrayDate[0];
        $month = $arrayDate[1];
        $day = $arrayDate[2];

        if (strlen($year) != 4) {
            return false;
        }
        if (strlen($month) != 2) {
            return false;
        }
        if (strlen($day) != 2) {
            return false;
        }
        $parse_result = date_parse($date);
        if ($parse_result['warning_count'] > 0 || $parse_result['error_count'] > 0) {
            return false;
        }
        return true;
    }

    public function checkTermId($term, $listTerm)
    {
        $term_name = strtoupper($term);
        $checkTermName = array_change_key_case($listTerm, CASE_UPPER);
        $result = null;
        if (array_key_exists($term_name, $checkTermName)) {
            $result = $checkTermName[$term_name];
        }
        return $result;
    }

    public function getKeyRoomId($room, $listRoom)
    {
        $result = null;
        $listRoom = array_change_key_case($listRoom, CASE_UPPER);
        if (array_key_exists($room, $listRoom)) {
            $result = $listRoom[$room];
        }
        return $result;
    }

    public function validateCourseSession($courseSession)
    {
        if (!is_numeric($courseSession)) {
            return false;
        }
        return true;
    }

    public function validateTime($start_time, $end_time)
    {
        $arrayStartTime = explode(':', $start_time);
        $arrayEndTime = explode(':', $end_time);
        if (count($arrayStartTime) != 3 && count($arrayEndTime) != 3) {
           return false;
        }
        $hourStart = $arrayStartTime[0];
        $minuteStart = $arrayStartTime[1];
        $secondStart = $arrayStartTime[2];

        $hourEnd = $arrayEndTime[0];
        $minuteEnd = $arrayEndTime[1];
        $secondEnd = $arrayEndTime[2];

        if (strlen($hourStart) != 2 && strlen($minuteStart) != 2 && strlen($secondStart) != 2) {
            return false;
        }

        if ((strlen($hourEnd) != 2) || (strlen($minuteEnd) != 2) || (strlen($secondEnd) != 2)) {
            return false;
        }
        return true;
    }

    public function checkTeacherFreeOn($teacher_login, $date, $start_time, $end_time) {
        $intDate = strtotime($date);
        $formatDate = date('Y-m-d', $intDate);
        $lowerTeacher = strtolower($teacher_login);
        $listActivity = Acitivitys::where('day', $formatDate)
            ->where('start_at', $start_time)->where('end_at', $end_time)
            ->where('leader_login',$lowerTeacher)
            ->whereNotIn('leader_login', ['thulk2','tranvtb2','nganpnt2'])
            ->count();
        if(!empty($listActivity) && $listActivity > 0) {
            return false;
        }
        return true;
    }

    public function getSubjectIdBySubjectCode() {

    }
}
