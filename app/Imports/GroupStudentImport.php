<?php

namespace App\Imports;

use App\Models\Fu\ActivityGroups;
use App\Models\Fu\Activitys;
use App\Models\Fu\Campus;
use App\Models\Fu\Course;
use App\Models\Fu\GroupMember;
use App\Models\Fu\Groups;
use App\Models\Fu\Subjects;
use App\Models\Fu\Terms;
use App\Models\User;
use App\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Imports\BaseImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS;

class GroupStudentImport extends BaseImport
{
    /**
     * Import data.
     *
     * @param Collection $collection
     * @return mixed
     */
    public function import(Collection $collection)
    {


        $input = [];
        $quantity = 0;
        foreach ($collection as $childCollection) {
            $keys = $childCollection[0]->toArray();
            $childCollection->forget(0);
            foreach ($childCollection as $value) {
                foreach ($keys as $index => $field) {

                    $input[$quantity][$field] = $value[$index];
                }
                ++$quantity;
            }
        }
        $result = [];
        foreach ($input as $item) {
            $student_code = $item['user_code'];
            $term_name = trim($item['term_name']);
            $student_login = $this->getStudentLoginBySubjectCode($student_code);
            $user_login = $student_login->user_login;
            if (isset($user_login)) {
                if ($this->check_if_student_existing($user_login)) {
                    if (!Service::getStudyStatus()->canBeGroupMember(Service::getStudyStatus()->getStudyStatusStudent($user_login))) {
                        $result[] = "Sinh viên <strong>$user_login</strong> đang trong tình trạng không được phép xếp lớp (dropout/đình chỉ/đã tốt nghiệp/đã chuyển cơ sở/không xác định).";
                    } else {
                        $term_id = $this->get_term_id_by_term_name($term_name);
                        if (isset($term_id)) {
                            $subject_id = $this->get_subject_id_by_subject_code($item['subject_code']);
                            if (isset($subject_id)) {
                                $course_id = $this->get_course_id_by($subject_id, $term_id);
                                if (is_null($course_id)) {
                                    $course = $this->create_new_course($subject_id, $term_id);
                                    if (isset($course)) {
                                        $course_id = $this->get_course_id_by($subject_id, $term_id);
                                      return  "Đã tạo thành công khóa học môn " . $item['subject_code'];
                                    } else {
                                        return "Không thể tạo được khóa học môn " . $item['subject_code'] . ' ở học kì ' . $item['term_name'];
                                    }
                                }
                                $group_id = $this->get_group_id_by($item['group_name'], $course_id);
                                if (is_null($group_id)) {
                                    $group = $this->create_new_group($item['group_name'], $course_id);
                                    if ($group) {
                                        $group_id = $this->get_group_id_by($item['group_name'], $course_id);
                                        return "Đã tạo thành công lớp " . $item['group_name'] . ' - ' . $item['subject_code'];
                                    } else {
                                        return "Không thể tạo được lớp " . $item['group_name'] . ' - ' . $item['subject_code'];
                                    }
                                }
                                $conflict = $this->check_student_group_conflict($user_login, $group_id);
                                $is_member = $this->check_if_student_is_a_member_of_group($user_login, $group_id);
                                if ($is_member) {
                                    return "Sinh viên " . $student_code . " đã là thành viên của lớp " . $item['group_name'] .
                                        ', ' . "môn " . $item['subject_code'] . ', ' . "học kì " . $item['term_name'];
                                } else {
                                    if ($conflict) {
                                        return "Không thể thêm sinh viên " . $student_code . "vào lớp " . $item['group_name'] .
                                            ', ' . "môn " . $item['subject_code'] . ', ' . "học kì " . $item['term_name'];
                                    } else {
                                        if ($this->check_time_add_member($group_id)) {
                                            $student = $this->add_student_to_group($user_login, $group_id);
                                            if ($student) {
                                                return "Đã thêm thành công sinh viên " .$student_code. "vào lớp ". $item['group_name']. ", " . "môn " . $item['subject_code'] . " học kì ". $item['term_name'];
                                            }
                                        } else {
                                            return "Không thể thêm sinh viên " . $student_code. " vào lớp ". $item['group_name'] . ", " . "môn " . $item['subject_code'] . ", " ."học kì " . $item['term_name']. " vì môn này đã học xong.";
                                        }
                                    }
                                }
                            } else {
                                return "Không tồn tại môn học có mã là" . $item['subject_code'];

                            }
                        } else {
                            return "Không tồn tại học kì có tên $term_name";
                        }
                    }
                }
            } else {
                return "Không tồn tại sinh viên có mã sinh viên là " . $student_code;
            }
        }
    }

    public function getStudentLoginBySubjectCode($student_code)
    {
        $student_login = User::where('user_code', $student_code)->where('user_level', 3)->select('user_login')->first();
        if (isset($student_login)) {
            return $student_login;
        }
        return null;
    }

    public function check_if_student_existing($student_login)
    {
        $getStudent = User::where('user_login', $student_login)->where('user_level', 3)->count();
        if ($getStudent > 0) {
            return true;
        }
        return false;
    }

    public function get_term_id_by_term_name($term_name)
    {
        $term = Terms::where('term_name', $term_name)->select('id')->first();

        if (isset($term)) {
            return $term->id;
        }
        return null;
    }

    public function get_term_name_by_term_id($term_id)
    {
        $term = Terms::where('id', $term_id)->select('term_name')->first();

        if (isset($term)) {
            return $term->term_name;
        }
        return null;
    }

    public function get_subject_id_by_subject_code($subject_code)
    {
        $subject = Subjects::where('subject_code', $subject_code)->select('id')->first();

        if (isset($subject)) {
            return $subject->id;
        }

        return null;
    }

    public function get_course_id_by($subject_id, $term_id)
    {
        $course = Course::where('subject_id', $subject_id)->where('term_id', $term_id)->select('id')->first();

        if (isset($course)) {
            return $course->id;
        }
        return null;
    }

    public function create_new_course($subject_id, $term_id)
    {
        $user = auth()->user();
        $subject = $this->getSubjectNameBySubjectCode($subject_id);
        $campus_id = Campus::where('campus_code', session('campus_db'))->first()->id;
        $subject_name = $subject->subject_name;
        $subject_code = $subject->subject_code;
        $term_name = $this->get_term_name_by_term_id($term_id);
        $is_started = 0;
        $result = Course::create([
            'lastmodifier_login' => $user->user_login,
            'campus_id' => $campus_id,
            'subject_id' => $subject_id,
            'term_id' => $term_id,
            'psubject_name' => $subject_name,
            'psubject_code' => $subject_code,
            'pterm_name' => $term_name,
            'is_started' => $is_started
        ]);
        if (isset($result)) {
            return true;
        }
        return false;
    }

    public function getSubjectNameBySubjectCode($subject_id)
    {
        $subject = Subjects::where('id', $subject_id)->select('subject_name', 'subject_code')->first();
        if (isset($subject)) {
            return $subject;
        }
        return null;
    }

    public function get_group_id_by($group_name, $course_id)
    {
        $group_id = Groups::where('type', 1)->where('group_name', $group_name)
            ->where('body_id', $course_id)->select('id')->first();

        if (isset($group_id)) {
            return $group_id->id;
        }
        return null;
    }

    public function create_new_group($group_name, $course_id)
    {
        $user = auth()->user();
        $type = 1;
        $subject_object = $this->get_subject_object_by_course_id($course_id);
        $term_object = $this->get_term_object_by_course_id($course_id);
        $subject_name = $subject_object['subject_name'];
        $subject_code = $subject_object['subject_code'];
        $subject_id = $subject_object['id'];
        $term_id = $term_object['id'];
        $term_name = $term_object['term_name'];
        $finished = 0;
        $is_started = 0;
        $result = Groups::create([
            'lastmodifier_login' => $user->user_login,
            'type' => $type,
            'body_id' => $course_id,
            'group_name' => $group_name,
            'psubject_name' => $subject_name,
            'psubject_code' => $subject_code,
            'finished' => $finished,
            'pterm_id' => $term_id,
            'psubject_id' => $subject_id,
            'pterm_name' => $term_name,
            'is_started' => $is_started
        ]);
        if (isset($result)) {
            return true;
        }
        return false;
    }

    public function get_subject_object_by_course_id($course_id)
    {
        $subjects = Subjects::join('fu_course', 'fu_subject.id', '=', 'fu_course.subject_id')->where('fu_course.id', $course_id)
            ->select('fu_subject.id', 'fu_subject.subject_name', 'fu_subject.subject_code')
            ->first()
            ->toArray();
        if (isset($subjects) && count($subjects) == 3) {
            return $subjects;
        }
        return null;
    }

    public function get_term_object_by_course_id($course_id)
    {
        $term_object = Terms::join('fu_course', 'fu_term.id', '=', 'fu_course.term_id')
            ->where('fu_course.id', $course_id)
            ->select('fu_term.term_name', 'fu_term.id')
            ->first()
            ->toArray();
        if (isset($term_object) && count($term_object) == 2) {
            return $term_object;
        }
        return null;
    }

    public function check_student_group_conflict($student_login, $group_id)
    {
        $result = Activitys::select('day', 'slot')
            ->join('fu_activity_groups', 'fu_activity.id', '=', 'fu_activity_groups.activity_id')
            ->join('fu_group_member', 'fu_activity_groups.groupid', '=', 'fu_group_member.groupid')
            ->where('fu_group_member.member_login', $student_login)
            ->where('fu_activity_groups.groupid', $group_id)
            ->where('fu_activity.done', 0)
            ->get()
            ->count();

        if ($result > 0) {
            return true;
        }
        return null;
    }

    public function check_if_student_is_a_member_of_group($student_login, $group_id)
    {
        $result = GroupMember::where('member_login', $student_login)
            ->where('groupid', $group_id)
            ->get()
            ->count();
        if (isset($result) && $result > 0) {
            return true;
        }
        return false;
    }

    public function check_time_add_member($group_id) {
        $now = Carbon::now()->toDateString();
        $end_date = Groups::where('id', $group_id)->where('end_date','>=', $now)->select('end_date')->first();
        if ($end_date) {
            return true;
        } else {
            return false;
        }
    }

    public function add_student_to_group($student_login, $group_id) {
        $now = Carbon::now()->toDateString();
        $result = GroupMember::create([
            'groupid' => $group_id,
            'member_login' => $student_login,
            'date' => $now
        ]);

        if (isset($result)) {
            return true;
        }
        return false;
    }
}
