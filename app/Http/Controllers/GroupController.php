<?php

namespace App\Http\Controllers;

use App\Models\Fu\Block;
use App\Models\Fu\Course;
use App\Models\Fu\Department;
use App\Models\Fu\Groups;
use App\Models\Fu\Room;
use App\Models\Fu\Slot;
use App\Models\Fu\Terms;
use App\Models\User;
use Carbon\Carbon;
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
                $stringName = $user->user_surname .' '. $user->user_middlename .' '. $user->user_givenname .' - '.
                    $user->user_login .' - '. $user->user_code .' - '. $user->cmt;
                $output .= '<li class="text-left"><a href="'. route('users.profile', ['id' => $user->id]) .'" class="version">'.$stringName.' </a></li>';
            }
            $output .= '</ul>';

            return $output;
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function schedule() {
        $slots = Slot::all();
        $roomDK = Room::where('area_id', 4)->get();
        $roomDT = Room::where('area_id', 9)->get();
        $date = Carbon::now();
        $day = $date->toDateString();
        $formatDate = date('d/m/Y', strtotime($day));

        return  view('admin.groups.schedule', compact('slots', 'roomDK', 'roomDT', 'formatDate', 'day'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function searchSchedule(Request $request) {
        $date = $request->date;
        $roomDK = Room::where('area_id', 4)->get();
        $roomDT = Room::where('area_id', 9)->get();
        $slots = Slot::all();
        $formatDate = date('d/m/Y', strtotime($date));

        return view('admin.groups.list-search-schedule', compact('slots', 'roomDK', 'roomDT', 'formatDate', 'date'));
    }

    public function create() {
        $terms = Terms::all();
        return view('admin.groups.create', compact('terms'));
    }

    public function store(Request $request) {
        $data = $request->all();
    }

    public function listGroup(Request $request) {
        $data = $request->all();
        if ($data['action']) {
            $output = "";
            if ($data['action'] == "term_id") {
                $course = Course::where('term_id', $data['id'])->get();
                foreach ($course as $item) {
                    $output .= '<option value="' . $item->psubject_code . ' ">' . $item->psubject_name . ' </option>';
                }
                return $output;
            }
        }
    }
}
