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
        $data = $request->all();
        $term_id = $request->term_id;
        if ($data['term_id'] == 0) {
            $coures = Course::all();
            return view('admin.groups.search', compact('coures'));
        }
        $groups = Groups::where('pterm_id', $term_id)->get();
        $term = Terms::orderBy('id', 'DESC')->first();
        $terms = Terms::all();
        $departments = Department::all();
        $courses = Course::where('term_id', $term_id)->get();
        $blocks = Block::where('term_id', $term_id)->get();
//        if ($data['term_id'] == 0) {
//            $groups = Groups::all();
//            return view('admin.groups.search', compact('groups', 'term', 'terms', 'departments', 'courses', 'blocks', 'term_id'));
//        }
        return view('admin.groups.search', compact('groups', 'term', 'terms', 'departments', 'courses', 'blocks', 'term_id'));
    }
}
