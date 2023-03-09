<?php

namespace App\Http\Controllers;

use App\Models\Fu\Department;
use App\Models\Fu\Groups;
use App\Models\Fu\Subjects;
use App\Models\Fu\Terms;
use App\Models\SessionType;
use App\Models\T7\GradeGroup;
use App\Models\T7\GradeSyllabus;
use App\Models\T7\SyllabusPlan;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createSubject(Request $request) {
        $id = $request->id;
        $syllabus = GradeSyllabus::find($id);
        $subject_id = $syllabus->subject_id;
        $subject = Subjects::find($subject_id);
        $session_type = SessionType::all();
        $syllabusPlan = SyllabusPlan::where('syllabus_id', $id)->get();
        $gradeGroup = GradeGroup::find($id);

        return view('admin.subjects.create', compact('syllabus', 'subject',
            'session_type', 'syllabusPlan', 'gradeGroup'));
    }

    public function getSubject(Request $request) {
        $id = $request->id;
        $view_child = $request->view_child;
        $terms = Terms::orDerby('id', 'desc')->get();
        $term = Terms::orDerby('id', 'desc')->first();
        $subject = Subjects::find($id);
        $syllabus = GradeSyllabus::find($id);
        $groupsSyllabus= GradeSyllabus::where('subject_id', $id)->get();
        $groupTerm = Groups::where('pterm_id', $term->id)->where('psubject_id', $id)->get();

        return view('admin.subjects.list', compact('subject', 'groupsSyllabus',
            'syllabus', 'view_child', 'terms', 'groupTerm'));
    }

    public function searchTerm(Request $request) {
        $subject_id = $request->subject_id;
        $term_id = $request->term_id;
        $groupTerm = Groups::where('pterm_id', $term_id)->where('psubject_id', $subject_id)->get();
        $output = "";
        foreach ($groupTerm as $group){
            $output.= '<div class="kt-widget__blog"  style="margin-right: 10px; border: 1px solid #a4a4a4; padding: 5px; border-radius: 13px">';
            $output.= '<i class="flaticon2-list-1"></i>';
            $output.= '<a href="'.route('course.group', ['id' => $group->id]).'" class="kt-widget__value kt-font-brand">'. $group->group_name .'</a>';
            $output .= '</div>';
        }

        return $output;
    }
}
