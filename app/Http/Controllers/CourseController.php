<?php

namespace App\Http\Controllers;

use App\Models\Fu\Course;
use App\Models\Fu\Department;
use App\Models\Fu\GroupMember;
use App\Models\Fu\Groups;
use App\Models\Fu\Subjects;
use App\Models\Fu\Terms;
use App\Models\T7\GradeSyllabus;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $course = Course::all();
        $terms = Terms::all();
        $department = Department::all();

        return view('admin.course.index', compact('course', 'terms', 'department'));
    }

    public function createRooms()
    {
        $terms = Terms::all();
        $subjects = Subjects::all();
        $syllabus = GradeSyllabus::all();

        return view('admin.course.create', compact('terms', 'subjects', 'syllabus'));
    }

    public function listCourse(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = "";
            if ($data['action'] == "term_id") {
                $course = Course::where('term_id', $request->id)->get();
                foreach ($course as $item) {
                    $course_name = $item->psubject_code . ' - ' . $item->psubject_name;
                    $output .= '<option value="' . $item->id . ' ">' . $course_name . ' </option>';
                }
            } else {
                $syllabus = GradeSyllabus::where('subject_id', $request->id)->get();
                foreach ($syllabus as $item) {
                    $output .= '<option value="' . $item->id . ' ">' . $item->syllabus_name . ' </option>';
                }
            }
        }

        return $output;
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function doSearch(Request $request)
    {
        $term_id = $request->term_id;

        $department_id = $request->department_id;
        if ($term_id) {
            $output = "";
            $courses = Course::where('term_id', $term_id)->get();
            foreach ($courses as $course) {
                $output .= '<tr>';
                $output .= '<td> ' . $course->id . '</td>';
                $output .= '<td>' . $corse_name . '</td>';
                $output .= '<td>' . $subject_name . '</td>';
                $output .= '<td>' . $item->psubject_code . '</td>';
                $output .= '<td>' . $item->syllabus_name . '</td>';
                $output .= '<td>' . $item->num_of_group . '</td>';
                $output .= '<td class="text-nowrap">';
                $output .= '<a href="" data-toggle="tooltip" data-original-title="Edit"><i class="flaticon-edit"></i></a>';
                $output .= '</td>';
                $output .= '</tr>';
            }
            return $output;
        }
    }

    public function edit(Request $request) {
        $course = Course::find($request->id);
        $terms = Terms::all();
        $syllabus = GradeSyllabus::all();
        $subjects = Subjects::all();
        $subject_id = $course->subject_id;
        $groups = Groups::where('psubject_id', $subject_id)
            ->where('pterm_id', $course->term_id)
            ->get();
        return view('admin.course.edit', compact('terms', 'course', 'subjects', 'syllabus', 'groups'));
    }

    public function listGroup(Request $request) {
        $id = $request->id;
        $groupMember = GroupMember::where('groupid', $id)->get();

        return  view('admin.course.list-group', compact('groupMember'));
    }
}
