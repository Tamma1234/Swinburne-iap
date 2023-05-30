<?php

namespace App\Http\Controllers;

use App\Models\Fu\Activitys;
use App\Models\Fu\Attendance;
use App\Models\Fu\Course;
use App\Models\Fu\Department;
use App\Models\Fu\GroupMember;
use App\Models\Fu\Groups;
use App\Models\Fu\Slot;
use App\Models\Fu\Subjects;
use App\Models\Fu\Terms;
use App\Models\T7\CourseResult;
use App\Models\T7\GradeSyllabus;
use App\Models\T7\SyllabusPlan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $term = Terms::orderBy('id', 'DESC')->first();
        $course = Course::where('term_id', $term->id)->get();
        $terms = Terms::all();
        $department = Department::all();

        return view('admin.course.index', compact('course', 'terms', 'department', 'term'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createRooms()
    {
        $terms = Terms::all();
        $subjects = Subjects::all();
        $syllabus = GradeSyllabus::all();

        return view('admin.course.create', compact('terms', 'subjects', 'syllabus'));
    }

    /**
     * @param Request $request
     * @return string
     */
    public function listCourse(Request $request)
    {
        $syllabus = GradeSyllabus::where('subject_id', $request->subject_id)->get();
        $output = "";
        foreach ($syllabus as $item) {
            $output .= '<option value="' . $item->id . ' ">' . $item->syllabus_name . '</option>';
        }
        return $output;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $term = Terms::find($request->term_id);
        $syllabus = GradeSyllabus::find($request->syllabus_id);
        $subject = Subjects::find($request->subject_id);
        $groups_name = $request->groups_name;
        $user = auth()->user();
        $groups_name_array = explode(",", $groups_name);
        $course = Course::create([
            'psubject_name' => $subject->subject_name,
            'psubject_code' => $subject->subject_code,
            'subject_id' => $request->subject_id,
            'term_id' => $request->term_id,
            'pterm_name' => $term->term_name,
            'syllabus_id' => $request->syllabus_id,
            'syllabus_name' => $syllabus->syllabus_name,
            'attendance_required' => $request->attendance_required,
            'grade_required' => $request->grade_required,
            'num_of_group' => $request->num_of_group,
            'lastmodifier_login' => $user->user_login
        ]);
        $course_id = $course->id;
        $content = [];
        foreach ($groups_name_array as $item) {
          $content[] = [
              'lastmodifier_login' => $user->user_login,
              'type' => 1,
              'body_id' => $course_id,
              'group_name' => $item,
              'psubject_name' => $subject->subject_name,
              'pterm_name' => $term->term_name,
              'psubject_code' => $subject->subject_code,
              'syllabus_id' => $request->syllabus_id,
              'attendance_required' => $request->attendance_required,
              'pterm_id' => $request->term_id,
              'psubject_id' => $request->subject_id,
          ];
        }
        Groups::insert($content);

        return redirect()->route('course.index')->with('msg-add', 'Create Course Successful');
    }

    /**
     * @param Request $request
     * @return string|void
     */
    public function doSearch(Request $request)
    {
        $term_id = $request->term_id;
        $i = 1;
        $department_id = $request->department_id;
        if ($term_id && $department_id == null) {
            $output = "";
            $course = Course::where('term_id', $term_id)->get();
//            foreach ($courses as $course) {
//                $course_name = $course->psubject_name . ' ' . $course->pterm_name;
//                $syllabus_name = $course->syllabus ? $course->syllabus->syllabus_name : "";
//                $syllybus_id = $course->syllabus ? $course->syllabus->id : "";
//                $output .= '<tr>';
//                $output .= '<td> ' . $i++ . '</td>';
//                $output .= '<td class="text-primary font-weight-bold"><a class="version" href="'.route('course.edit', ['id' => $course->id]).'">' . $course_name . '</a></td>';
//                $output .= '<td>' . $course->psubject_name . '</td>';
//                $output .= '<td>' . $course->psubject_code . '</td>';
//                $output .= '<td class="text-primary font-weight-bold"><a class="version" href="'.route('subject.create', ['id' => $syllybus_id]).'">' . $syllabus_name . '</a></td>';
//                $output .= '<td>' . $course->num_of_group . '</td>';
//                $output .= '<td class="text-nowrap">';
//                $output .= '<a href="' . route('course.edit', ['id' => $course->id]) . '" data-toggle="tooltip" data-original-title="Edit"><i class="flaticon-edit"></i></a>';
//                $output .= '</td>';
//                $output .= '</tr>';
//            }
//            $output .= '<input type="hidden" id="totalCourse" value="' . count($courses) . '">';
            return view('admin.course.search-term', compact('course'));
        } elseif ($term_id && $department_id) {
            $course = Course::join('fu_subject', 'fu_course.subject_id', '=', 'fu_subject.id')
                ->where('fu_course.term_id', $term_id)
                ->where('fu_subject.department_id', $department_id)
                ->get();
//            $output .= '<input type="hidden" id="totalCourse" value="' . count($department_term) . '">';
            return view('admin.course.search-term', compact('course'));

        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request)
    {
        $course = Course::find($request->id);
        $terms = Terms::all();
        $syllabus = GradeSyllabus::all();
        $subjects = Subjects::all();
        $subject_id = $course->subject_id;
        $groups = Groups::where('psubject_id', $subject_id)
            ->where('pterm_id', $course->term_id)
            ->get();
        $activity = Activitys::where('course_id', $request->id)
            ->where('term_id', $course->term_id)
            ->get();

        $leaderActivity = Activitys::where('psubject_id', $subject_id)
            ->where('term_id', $course->term_id)
            ->select('leader_login')
            ->distinct()
            ->get();
        $syllabusCourse = SyllabusPlan::where('subject_id', $subject_id)
            ->where('syllabus_id', $course->syllabus_id)
            ->get();

        return view('admin.course.edit', compact('terms', 'course',
            'subjects', 'syllabus', 'groups', 'activity', 'leaderActivity', 'syllabusCourse'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function listGroup(Request $request)
    {
        $id = $request->id;
        $groupMember = GroupMember::where('groupid', $id)->get();
        $group = Groups::find($id);
        $subject = Subjects::find($group->psubject_id);
        $department = Department::find($subject->department_id);
        $activityGroup = Activitys::where('groupid', $id)->get();
        $slots = Slot::all();
        $courseResult = CourseResult::where('groupid', $id)->get();
        $attendances = Attendance::where('groupid', $id)->get();
        $groupAnother = Groups::where('psubject_id', $group->psubject_id)
            ->where('pterm_id', $group->pterm_id)
            ->where('id', '!=', $id)
            ->get();

        return view('admin.course.list-group', compact('groupMember', 'group',
            'department', 'activityGroup', 'slots', 'courseResult', 'attendances', 'id', 'groupAnother'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function listSubject(Request $request)
    {
        $subjects = Subjects::all();
        $departments = Department::all();
        return view('admin.course.list-subject', compact('subjects', 'departments'));
    }

    /**
     * @param Request $request
     * @return string
     */
    public function subjectSearch(Request $request)
    {
        $department_id = $request->department_id;
        $output = "";
        if ($department_id != 0) {
            $subjects = Subjects::where('department_id', $request->department_id)->get();
            foreach ($subjects as $item) {
                $department_name = $item->departments ? $item->departments->department_name : "";
                $output .= '<tr>';
                $output .= '<td>' . $department_name . '</td>';
                $output .= '<td class="text-primary font-weight-bold"> <a class="version font-weight-bold"
               href="' . route('course.edit', ['id' => $item->id]) . ' ">' . $item->subject_name . '</a></td>';
                $output .= '<td>' . $item->subject_code . '</td>';
                $output .= '<td class="text-primary font-weight-bold">';
                foreach ($item->gradeSyllabus as $grade) {
                    $output .= '<a href="' . route('subject.create', ['id' => $grade->id]) . '" class="version font-weight-bold">' . $grade->syllabus_name . ' </a>';
                    $output .= '<span class="text-dark font-weight-bold">(' . $grade->syllabus_code . ')</span>';
                    $output .= '<br>';
                }
                $output .= '<td>' . $item->subject_code . '</td>';
                $output .= '<td>' . $item->num_of_credit . '</td>';
                $output .= '</tr>';
            }
            $output .= '<input id="totalSubject" type="hidden" value="' . count($subjects) . '">';

            return $output;
        } else {
            $subjects = Subjects::all();
            foreach ($subjects as $item) {
                $department_name = $item->departments ? $item->departments->department_name : "";
                $output .= '<tr>';
                $output .= '<td>' . $department_name . '</td>';
                $output .= '<td class="text-primary font-weight-bold"> <a class="version font-weight-bold"
               href="' . route('course.edit', ['id' => $item->id]) . ' ">' . $item->subject_name . '</a></td>';
                $output .= '<td>' . $item->subject_code . '</td>';
                $output .= '<td class="text-primary font-weight-bold">';
                foreach ($item->gradeSyllabus as $grade) {
                    $output .= '<a href="#" class="version font-weight-bold">' . $grade->syllabus_name . ' </a>';
                    $output .= '<span class="text-dark font-weight-bold">(' . $grade->syllabus_code . ')</span>';
                    $output .= '<br>';
                }
                $output .= '<td>' . $item->subject_code . '</td>';
                $output .= '<td>' . $item->num_of_credit . '</td>';
                $output .= '</tr>';
            }
            $output .= '<input id="totalSubject" type="hidden" value="' . count($subjects) . '">';

            return $output;
        }
    }
}
