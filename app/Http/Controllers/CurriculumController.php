<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Dra\Curriculum;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function index() {
        $curriculums = Curriculum::all();
        return view('admin.curriculums.index', compact('curriculums'));
    }

    public function create() {
        return view('admin.curriculums.create');
    }

    public function store() {

    }

    public function edit(Request $request) {
        $id = $request->id;
        $curriculum = Curriculum::find($id);
        $brands = Brand::all();
        return view('admin.curriculums.edit', compact('curriculum', 'brands'));
    }

    public function update() {

    }
}
