<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupMemberRequest;
use App\Models\Fu\Block;
use App\Models\Fu\Course;
use App\Models\Fu\Department;
use App\Models\Fu\GroupMember;
use App\Models\Fu\Groups;
use App\Models\Fu\Room;
use App\Models\Fu\Slot;
use App\Models\Fu\Terms;
use http\Env\Response;
use Illuminate\Support\Facades\DB;
use App\Models\T7\CourseResult;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $term = Terms::orderBy('id', 'DESC')->first();
        $groups = Groups::where('pterm_id', $term->id)->get();
        $terms = Terms::all();
        $departments = Department::all();
        $courses = Course::all();

        return view('admin.groups.index', compact('groups', 'terms', 'departments', 'term', 'courses'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $term_id = $request->term_id;
        $department_id = $request->department_id;
        $course_id = $request->course_id;
        $term = Terms::orderBy('id', 'DESC')->first();
        $terms = Terms::all();
        $departments = Department::all();
        $courses = Course::where('term_id', $term_id)->get();
        $blocks = Block::where('term_id', $term_id)->get();

        if ($term_id == null) {
            $groups = Groups::all();

            return view('admin.groups.search', compact('groups', 'term', 'terms',
                'departments', 'courses', 'blocks', 'term_id', 'department_id'));
        } else {
            if ($term_id && $department_id && $course_id == null) {
                $groups = Groups::join('fu_subject', 'fu_group.psubject_id', 'fu_subject.id')
                    ->where('pterm_id', $term_id)->where('fu_subject.department_id', $department_id)->get();

                return view('admin.groups.search', compact('groups', 'term', 'terms',
                    'departments', 'courses', 'blocks', 'term_id', 'department_id', 'course_id'));
            } elseif ($term_id && $department_id && $course_id) {
                $groups = Groups::join('fu_subject', 'fu_group.psubject_id', 'fu_subject.id')
                    ->join('fu_course', 'fu_subject.id', 'fu_course.subject_id')
                    ->where('pterm_id', $term_id)->where('fu_subject.department_id', $department_id)
                    ->where('fu_course.id', $course_id)
                    ->get();

                return view('admin.groups.search', compact('groups', 'term', 'terms',
                    'departments', 'courses', 'blocks', 'term_id', 'department_id', 'course_id'));
            }
            $groups = Groups::where('pterm_id', $term_id)->get();

            return view('admin.groups.search', compact('groups', 'term', 'terms',
                'departments', 'courses', 'blocks', 'term_id', 'department_id', 'course_id'));
        }
//        if ($data['term_id'] == 0) {
//            $groups = Groups::all();
//            return view('admin.groups.search', compact('groups', 'term', 'terms', 'departments', 'courses', 'blocks', 'term_id'));
//        }
    }

    /**
     * @param Request $request
     * @return string
     */
    public function valueSearch(Request $request)
    {
        $value = $request->value;
        $output = "";
        if ($value == null) {
            return $output;
        } else {
            $users = User::where('user_givenname', 'LIKE', "%$value%")
                ->orWhere('user_surname', 'LIKE', "%$value%")
                ->orWhere('user_middlename', 'LIKE', "%$value%")
                ->orWhere('user_code', 'LIKE', "%$value%")
                ->get();

            $output .= '<ul id="style-select" class="dropdown-menu inner show">';
            foreach ($users as $user) {
                $stringName = $user->user_surname . ' ' . $user->user_middlename . ' ' . $user->user_givenname . ' - ' .
                    $user->user_login . ' - ' . $user->user_code . ' - ' . $user->cmt;
                $output .= '<li class="text-left"><a href="' . route('users.profile', ['id' => $user->id]) . '" class="version">' . $stringName . ' </a></li>';
            }
            $output .= '</ul>';

            return $output;
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function schedule()
    {
        $slots = Slot::all();
        $roomDK = Room::where('area_id', 4)->get();
        $roomDT = Room::where('area_id', 9)->get();
        $date = Carbon::now();
        $day = $date->toDateString();
        $formatDate = date('d/m/Y', strtotime($day));

        return view('admin.groups.schedule', compact('slots', 'roomDK', 'roomDT', 'formatDate', 'day'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function searchSchedule(Request $request)
    {
        $date = $request->date;
        $roomDK = Room::where('area_id', 4)->get();
        $roomDT = Room::where('area_id', 9)->get();
        $slots = Slot::all();
        $formatDate = date('d/m/Y', strtotime($date));

        return view('admin.groups.list-search-schedule', compact('slots', 'roomDK', 'roomDT', 'formatDate', 'date'));
    }

    public function create()
    {
        $terms = Terms::all();
        $departments = Department::all();
        return view('admin.groups.create', compact('terms', 'departments'));
    }

    public function store(Request $request)
    {
        $course = Course::find($request->course_id);
        $group_name_array = explode(",", $request->group_name);
        $content = [];
        foreach ($group_name_array as $item) {
            $content[] = [
                'pterm_id' => $request->term_id,
                'group_name' => $item,
                'psubject_id' => $course->subject_id,
                'psubject_name' => $course->psubject_name,
                'psubject_code' => $course->psubject_code
            ];
        }
        Groups::insert($content);

        return redirect()->route('group.list')->with('msg-add', "Create Group Successful");
    }

    public function listGroup(Request $request)
    {
        $term_id = $request->term_id;
        $department_id = $request->department_id;
        if ($term_id != 0 && $department_id == 0) {
            $course = Course::where('term_id', $term_id)->get();
            return response()->json($course);
        } elseif ($term_id != 0 && $department_id != 0) {
            $course = Course::join('fu_subject', 'fu_course.subject_id', '=', 'fu_subject.id')
                ->where('fu_subject.department_id', $department_id)
                ->where('term_id', $term_id)->get();
            return response()->json($course);
        } elseif ($term_id == 0 && $department_id != 0) {
            $course = Course::join('fu_subject', 'fu_course.subject_id', '=', 'fu_subject.id')
                ->where('fu_subject.department_id', $department_id)->get();
            return $course;
        } else {
            $course = Course::all();
            return $course;
        }
    }

    public function addStudent(Request $request)
    {
        $student_name = $request->student_name;
        $student_name_array = explode(",", $student_name);
        $group_id = $request->group_id;
        $group = Groups::find($group_id);
        $groupMember = GroupMember::where('groupid', $group_id)->pluck('member_login')->toArray();
        $likeArray = array_intersect($student_name_array,$groupMember);
        if (count($likeArray) < 0) {
            $data = [];
            $date = Carbon::now()->toDateTimeString();
            foreach ($student_name_array as $student) {
                $data[] = [
                    'member_login' => $student,
                    'groupid' => $group_id,
                    'date' => $date,
                    'subject_code' => $group->psubject_code,
                    'group_name' => $group->group_name,
                    'term_id' => $group->pterm_id
                ];
            }
            GroupMember::insert($data);
            $groupMember = GroupMember::where('groupid', $group_id)->get();
            $output = "";
            $i = 1;
            foreach ($groupMember as $group) {
                $user = User::where('user_login', $group->member_login)->first();
                $full_name = $user->user_surname . ' ' . $user->user_middlename . ' ' . $user->user_givenname;
                $output .= '<tr>';
                $output .= '<td>' . $i++ . '</td>';
                $output .= '<td class="text-primary">' . $group->member_login . '</td>';
                $output .= '<td>' . $user->user_code . '</td>';
                $output .= '<td>' . $user->user_code_au . '</td>';
                $output .= '<td>' . $full_name . '</td>';
                $output .= '<td>' . $group->date . '</td>';
                $output .= '</tr>';
            }
            return $output;
        } else {
            return response()->json(['errorType' => $likeArray]);
        }
    }

    public function importClass() {
        return view('admin.groups.import-class');
    }

    function postImporClass(Request $request) {
//        $request->validate([
//            'file' => 'required|mimes:xlsx'
//        ]);
        dd($request->file('file'));
    }
}
