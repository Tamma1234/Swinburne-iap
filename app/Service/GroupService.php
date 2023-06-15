<?php

namespace App\Service;

use App\Models\Fu\ActivityGroups;
use App\Models\Fu\ActivityLeaders;
use App\Models\Fu\Activitys;
use App\Models\Fu\Campus;
use App\Models\Fu\Course;
use App\Models\Fu\Groups;
use App\Models\Fu\Room;
use App\Models\Fu\Subjects;
use App\Models\Fu\Terms;
use App\Models\T7\SyllabusPlan;
use Illuminate\Support\Facades\Mail;

class GroupService
{
    public function checkGroupName($group)
    {
        $term = Terms::select('id', 'term_name')->pluck('id', 'term_name')->toArray();
        $listTerm = array_change_key_case($term, CASE_UPPER);

        $list_subject = Subjects::select('id', 'subject_code', 'subject_name')->get();
        $arrayListSubjectCode = $list_subject->pluck('id', 'subject_code')->toArray();
        $arrayListSubjectName = $list_subject->pluck('subject_name', 'subject_code')->toArray();
        $list_room = Room::select('id', 'room_name')->pluck('id', 'room_name')->toArray();
        $list_subject_by_id = Course::selectRaw('CONCAT(id) AS id, CONCAT(term_id, psubject_code) AS Name')->pluck('id', 'Name')->toArray();
        $listCourseGroup = Groups::selectRaw("CONCAT(group_name, body_id) AS name, CONCAT(id) AS id")
            ->where("type", 1)->pluck('id', 'name')->toArray();

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
            $group_name = $item['group_name'];
            $term_id = $this->checkTermId($term, $listTerm);

            $checkGroupName = Groups::where('pterm_name', $term)
                ->where('group_name', $group_name)->select('group_name')
                ->first();
            if (empty($term_id)) {
                $result[] = "Không tìm thấy học kỳ " . $term . " trong danh sách học kỳ";
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
                $result[] = "Không tìm thấy phòng " . $room . " trong danh sách phòng";
                continue;
            }
            if (!$this->checkTeacherFreeOn($teacher_login, $date, $start_time, $end_time)) {
                $result[] = "Giảng viên " . $teacher_login . " Đã bận vào ca này";
                continue;
            }

            $subject_id = $this->getSubjectIdBySubjectCode($subject_code, $arrayListSubjectCode);
            if (empty($subject_id)) {
                $result[] = "Không tìm thấy mã " . $subject_code . " trong danh sách lớp";
                continue;
            }

            if (!$this->validateCourseSession($course_session)) {
                $result[] = "Ca học phải là 1 số tự nhiên từ 1 đến 7";
                continue;
            }

            $course_id = $this->getCourseSession($subject_code, $term_id, $list_subject_by_id);
            if (empty($course_id)) {
                $subject_name = $this->getSubjectCodeBySubjectName($subject_code, $arrayListSubjectName);
                $course_id = $this->createNewCourse($subject_name, $subject_code, $term_id, $term, $list_subject_by_id);
            }

            if (empty($course_id) || $course_id == false) {
                $result[] = "Không tạo được khóa học môn " . $subject_code . " học kỳ " . $term;
                break;
            }

            $listSyllabus = Course::select('id', 'syllabus_id')->pluck('syllabus_id', 'id')->toArray();
            $syllabus_id = $this->getSyllabusIdByCourseId($course_id, $listSyllabus);
            if (!empty($syllabus_id) && $syllabus_id > 0) {
                if (!$this->check_if_course_session_is_existing_in_syllabus($course_session, $syllabus_id)) {
                    $result[] = 'Không tìm thấy định nghĩa buổi học thứ ' . $course_session . ' của khóa học môn ' . $subject_code . ' học kỳ ' . $term;
                }
            }

            $group_id = $this->getGroupId($group_name, $course_id, $listCourseGroup);
            if (empty($group_id)) {
                $group_id = $this->create_new_group($group_name, $course_id, $listCourseGroup);
            }

            $groupArray = [];
            if ($group_id > 0) {
                $group = new Groups();
                $group->id = $group_id;
                $group->name = $group_name;
                $group->course_id = $course_id;
                $groupArray = $group;
            } else {
                $result[] = "Không thể tạo được lớp" . $group_name . ' học môn ' . $subject_code . ' học kỳ ' . $term;
                break;
            }
            if (empty($groupArray)) {
                $result[] = "Bị lỗi do không tìm thấy tên lớp $group_name được import trong danh sách lớp, khóa";
            }
            if ($this->check_if_course_session_duplicate($course_session, $group_id)) {
                $result[] = 'Buổi học thứ ' . $course_session . ' của lớp ' . $group_id . $group_name  . $subject_code . ' đã được xếp lịch.';
               return $result;
                break;
            }
//            if (!empty($result)) {
//                return $result;
//            } else {
//                $now = date('Y-m-d H:i:s');
//                $user = auth()->user();
//                $intDate = strtotime($date);
//                $formatDate = date('Y-m-d', $intDate);
//                $insertActivity = Activitys::create([
//                    "day" => $formatDate,
//                    "start_at" => $start_time,
//                    "end_at" => $end_time,
//                    'groupid' => $group_id,
//                    'room_id' => $room_id,
//                    'course_slot' => $course_session,
//                    'lastmodifier_login' => $user->user_login,
//                    'done' => 0,
//                    'description' => '',
//                    'lastmodified_time' => $now
//                ]);
//                $activity_id = $insertActivity->id;
//                ActivityGroups::create([
//                    'activity_id' => $activity_id,
//                    'term_id_cache' => 0,
//                    'groupid' => $group_id,
//                    'group_name' => $group_name,
//                    'session_type_group' => 0
//                ]);
//                ActivityLeaders::create([
//                    'activity_id' => $activity_id,
//                    'leader_login' => $user->user_login
//                ]);
//            }
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

    public function checkTeacherFreeOn($teacher_login, $date, $start_time, $end_time)
    {
        $intDate = strtotime($date);
        $formatDate = date('Y-m-d', $intDate);
        $lowerTeacher = strtolower($teacher_login);
        $listActivity = Activitys::where('day', $formatDate)
            ->where('start_at', $start_time)->where('end_at', $end_time)
            ->where('leader_login', $lowerTeacher)
            ->whereNotIn('leader_login', ['thulk2', 'tranvtb2', 'nganpnt2'])
            ->count();
        if (!empty($listActivity) && $listActivity > 0) {
            return false;
        }
        return true;
    }

    public function getSubjectIdBySubjectCode($subject_code, $list_subject)
    {
        $subject_id = null;
        $subject_code = strtoupper($subject_code);
        $arrayListSubject = array_change_key_case($list_subject, CASE_UPPER);
        if (array_key_exists($subject_code, $arrayListSubject)) {
            $subject_id = $arrayListSubject[$subject_code];
        }
        return $subject_id;
    }

    public function getCourseSession($subject_code, $term_id, $list_subject_by_id)
    {
        $course_id = null;
        $subjectTermId = strtoupper($term_id . $subject_code);
        $arrayListSubject = array_change_key_case($list_subject_by_id, CASE_UPPER);
        if (array_key_exists($subjectTermId, $arrayListSubject)) {
            $course_id = $arrayListSubject[$subjectTermId];
        }
        return $course_id;
    }

    public function getSubjectCodeBySubjectName($subject_code, $list_subject)
    {
        $result = null;
        $subject_code = strtoupper($subject_code);
        $arrayListSubject = array_change_key_case($list_subject, CASE_UPPER);
        if (array_key_exists($subject_code, $arrayListSubject)) {
            $result = $arrayListSubject[$subject_code];
        }

        return $result;
    }

    public function createNewCourse($subject_name, $subject_code, $term_id, $term, $list_subject_by_id)
    {
        $user = auth()->user();
        $lastmodifier_login = $user->user_login;
        $is_started = 0;
        $campus_code = session('campus_db');
        $campus_id = Campus::select('id')->where('campus_code', $campus_code)->first()->id;
        $sql = Course::create([
            "lastmodifier_login" => $lastmodifier_login,
            "psubject_name" => $subject_name,
            "term_id" => $term_id,
            "campus_id" => $campus_id,
            "psubject_code" => $subject_code,
            "pterm_name" => $term,
            "is_started" => $is_started
        ]);
        $course_id = $sql->id;
        if ($course_id > 0) {
            return $course_id;
        }

        return false;
    }

    public function getSyllabusIdByCourseId($course_id, $listSyllabus)
    {
        $syllabus_id = null;
        $key = strtoupper($course_id);
        $arrayListSyllabus = array_change_key_case($listSyllabus, CASE_UPPER);

        if (array_key_exists($key, $arrayListSyllabus)) {
            $syllabus_id = $arrayListSyllabus[$key];
        }
        return $syllabus_id;
    }

    public function check_if_course_session_is_existing_in_syllabus($course_session, $syllabus_id)
    {
        if ($course_session >= 300 && $course_session <= 350) {
            return true;
        }
        $totalCourse = SyllabusPlan::where('course_session', $course_session)->where('syllabus_id', $syllabus_id)->count();

        if (!empty($totalCourse) && is_numeric($totalCourse) && $totalCourse > 0) {
            return true;
        }

        return false;
    }

    public function getGroupId($group_name, $course_id, $listCourseGroup)
    {
        $group_id = null;
        $key = strtoupper($group_name . $course_id);
        $arrayCourseGroup = array_change_key_case($listCourseGroup, CASE_UPPER);

        if (array_key_exists($key, $arrayCourseGroup)) {
            $group_id = $arrayCourseGroup[$key];
        }

        return $group_id;
    }

    public function create_new_group($group_name, $course_id, $listCourseGroup)
    {
        $subjectCorse = $this->getSubjectCourse($course_id);
        $termCourse = $this->getTermCourse($course_id);
        $lastmodifier_login = auth()->user()->user_login;
        $type = 1;
        $subject_code = $subjectCorse->subject_code;
        $subject_name = $subjectCorse->subject_name;
        $subject_id = $subjectCorse->id;
        $term_id = $termCourse->id;
        $term_name = $termCourse->term_name;
        $finished = 0;
        $is_started = 0;
        $group = Groups::create([
            'lastmodifier_login' => $lastmodifier_login,
            'type' => $type,
            'body_id' => $course_id,
            'group_name' => $group_name,
            'psubject_code' => $subject_code,
            'psubject_name' => $subject_name,
            'psubject_id' => $subject_id,
            'pterm_id' => $term_id,
            'pterm_name' => $term_name,
            'is_started' => $finished,
            'is_started' => $is_started
        ]);
        $group_new_id = $group->id;
        if ($group_new_id > 0) {
            return $group_new_id;
        }
        return false;
    }

    public function getSubjectCourse($course_id)
    {
        $result = Subjects::join('fu_course', 'fu_subject.id', '=', 'fu_course.subject_id')->where('fu_course.id', $course_id)
            ->select('fu_subject.id', 'fu_subject.subject_name', 'fu_subject.subject_code')
            ->first();
        if (isset($result)) {
            return $result;
        }
        return null;
    }

    public function getTermCourse($course_id)
    {
        $result = Terms::join('fu_course', 'fu_term.id', '=', 'fu_course.term_id')
            ->where('fu_course.id', $course_id)
            ->select('fu_term.id', 'fu_term.term_name')
            ->first();
        if (isset($result)) {
            return $result;
        }

        return false;
    }

    public function check_if_course_session_duplicate($course_session, $group_id) {
        $activitys = Activitys::where('groupid', $group_id)->where('course_slot', $course_session)->count();

        if (isset($activitys) && $activitys > 0) {
            return true;
        }
        return false;
    }
}
