<?php

namespace App\Http\Controllers;

use App\Models\Fu\Department;
use App\Models\Fu\Subjects;
use App\Models\T7\GradeSyllabus;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function createSubject(Request $request) {
        $id = $request->id;
        $syllabus = GradeSyllabus::find($id);
        $subject_id = $syllabus->subject_id;
        $subject = Subjects::find($subject_id);

        return view('admin.subjects.create', compact('syllabus', 'subject'));
    }
}
