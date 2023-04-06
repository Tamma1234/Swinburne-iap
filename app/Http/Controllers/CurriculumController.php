<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Dra\Curriculum;
use App\Models\Fu\Department;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function index() {
        $curriculums = Curriculum::all();
        $departments = Department::all();
        return view('admin.curriculums.index', compact('curriculums', 'departments'));
    }

    public function create() {
        $brands = Brand::all();
        return view('admin.curriculums.create', compact('brands'));
    }

    public function store(Request $request) {
        $data = $request->all();
        $curriculum = new Curriculum();
        $curriculum->fill($data);
        $curriculum->save();

        return redirect()->route('curriculum.index')->with('msg-add', 'Create Curriculum Successful');
    }

    public function edit(Request $request) {
        $id = $request->id;
        $curriculum = Curriculum::find($id);
        $brands = Brand::all();
        return view('admin.curriculums.edit', compact('curriculum', 'brands'));
    }

    public function update(Request $request) {
        $id = $request->id;
        $data = $request->all();
        $curriculum = Curriculum::find($id);
        $curriculum->fill($data);
        $curriculum->save();

        return redirect()->route('curriculum.index')->with('msg-add', 'Update Curriculum Successful');
    }

    public function Search(Request $request) {
        $department_id = $request->department_id;
    }
}
