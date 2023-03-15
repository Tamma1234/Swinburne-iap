<?php

namespace App\Http\Controllers;

use App\Models\Fu\Block;
use App\Models\Fu\Course;
use App\Models\Fu\Department;
use App\Models\Fu\Groups;
use App\Models\Fu\Terms;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $term = Terms::orderBy('id', 'DESC')->first();
        $groups = Groups::where('pterm_id', $term->id)->get();
        $terms = Terms::all();
        $departments = Department::all();
        $courses = Course::all();

        return view('admin.groups.index', compact('groups', 'terms', 'departments', 'term', 'courses'));
    }

    public function search(Request $request)
    {
        $term_id = $request->term_id;
        $department_id = $request->department_id;
        $course_id = $request->course_id;
//        $groups = Groups::where('pterm_id', $term_id)->get();
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

    public function postSearch(Request $request) {
        $search = $request->name;
        $dataName = Groups::where('psubject_name', 'LIKE', "%$search%")->get();
        dd($dataName);
        return $dataName;
    }
}
