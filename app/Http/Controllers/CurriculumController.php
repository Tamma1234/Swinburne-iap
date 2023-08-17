<?php

namespace App\Http\Controllers;

use App\Exports\CurriculumExport;
use App\Exports\ExportGroupSemmester;
use App\Models\Brand;
use App\Models\Dra\Curriculum;
use App\Models\Fu\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CurriculumController extends Controller
{
    public function exportStudenlist(Request $request) {
        dd(isset($_GET['curriculum_id']));
        if (isset($_GET['curriculum_id'])) {
            $curri_id = $_GET['curriculum_id'];
            if ($curri_id == "all") {
                $curriculums = User::where('user_level', 3)->join('dra_curriculum', 'fu_user.curriculum_id', '=', 'dra_curriculum.id')
                    ->select('fu_user.user_code', 'fu_user.user_surname', 'fu_user.user_middlename', 'fu_user.user_givenname', 'fu_user.user_DOB',
                        'fu_user.gender', 'fu_user.user_email', 'fu_user.promotion', 'dra_curriculum.khoa','dra_curriculum.name', 'dra_curriculum.chuyen_nganh', 'fu_user.user_address',
                        'fu_user.user_telephone', 'fu_user.personal_email', 'fu_user.parent_email1', 'fu_user.cmt', 'fu_user.ph_telephone2', 'fu_user.parent_email1')
                    ->get();
                $exports = new CurriculumExport([$curriculums]);
                return Excel::download($exports, 'DSSV_Curriculum.xlsx');

            } elseif ($curri_id == 0) {
                $curriculums = User::where('user_level', 3)->join('dra_curriculum', 'fu_user.curriculum_id', '=', 'dra_curriculum.id')
                    ->select('fu_user.user_code', 'fu_user.user_surname', 'fu_user.user_middlename', 'fu_user.user_givenname', 'fu_user.user_DOB',
                        'fu_user.gender', 'fu_user.user_email', 'fu_user.promotion', 'dra_curriculum.khoa','dra_curriculum.name', 'dra_curriculum.chuyen_nganh', 'fu_user.user_address',
                        'fu_user.user_telephone', 'fu_user.personal_email', 'fu_user.parent_email1', 'fu_user.cmt', 'fu_user.ph_telephone2', 'fu_user.parent_email1')
                    ->where('fu_user.curriculum_id', 0)
                    ->get();
                $exports = new CurriculumExport([$curriculums]);
                return Excel::download($exports, 'DSSV_Curriculum.xlsx');
            } else {
                $curriculums = User::where('user_level', 3)->join('dra_curriculum', 'fu_user.curriculum_id', '=', 'dra_curriculum.id')
                    ->select('fu_user.user_code', 'fu_user.user_surname', 'fu_user.user_middlename', 'fu_user.user_givenname', 'fu_user.user_DOB',
                        'fu_user.gender', 'fu_user.user_email', 'fu_user.promotion', 'dra_curriculum.khoa','dra_curriculum.name', 'dra_curriculum.chuyen_nganh', 'fu_user.user_address',
                        'fu_user.user_telephone', 'fu_user.personal_email', 'fu_user.parent_email1', 'fu_user.cmt', 'fu_user.ph_telephone2', 'fu_user.parent_email1')
                    ->where('fu_user.curriculum_id', $curri_id)
                    ->get();
                $exports = new CurriculumExport([$curriculums]);
                return Excel::download($exports, 'DSSV_Curriculum.xlsx');
            }
        } else {
            $curriculums = User::where('user_level', 3)->join('dra_curriculum', 'fu_user.curriculum_id', '=', 'dra_curriculum.id')
                ->select('fu_user.user_code', 'fu_user.user_surname', 'fu_user.user_middlename', 'fu_user.user_givenname', 'fu_user.user_DOB',
                    'fu_user.gender', 'fu_user.user_email', 'fu_user.promotion', 'dra_curriculum.khoa','dra_curriculum.name', 'dra_curriculum.chuyen_nganh', 'fu_user.user_address',
                    'fu_user.user_telephone', 'fu_user.personal_email', 'fu_user.parent_email1', 'fu_user.cmt', 'fu_user.ph_telephone2', 'fu_user.parent_email1')
                ->get();

            $exports = new CurriculumExport([$curriculums]);

            return Excel::download($exports, 'DSSV_Curriculum.xlsx');
        }
    }

    public function studentList()
    {
        $curriculum = Curriculum::all();
        if (isset($_GET['curriculum_id'])) {
            $curriculum_id = $_GET['curriculum_id'];
            if ($curriculum_id == "all") {
                $curriculums = User::where('user_level', 3)->join('dra_curriculum', 'fu_user.curriculum_id', '=', 'dra_curriculum.id')
                    ->select('fu_user.user_code', 'fu_user.user_surname', 'fu_user.user_middlename', 'fu_user.user_givenname', 'fu_user.user_DOB',
                        'fu_user.gender', 'fu_user.user_email', 'fu_user.promotion', 'dra_curriculum.khoa','dra_curriculum.name', 'dra_curriculum.chuyen_nganh', 'fu_user.user_address',
                        'fu_user.user_telephone', 'fu_user.personal_email', 'fu_user.parent_email1', 'fu_user.cmt', 'fu_user.ph_telephone2', 'fu_user.parent_email1')
                    ->get();
            } elseif ($curriculum_id == 0) {
                $curriculums = User::where('user_level', 3)->join('dra_curriculum', 'fu_user.curriculum_id', '=', 'dra_curriculum.id')
                    ->select('fu_user.user_code', 'fu_user.user_surname', 'fu_user.user_middlename', 'fu_user.user_givenname', 'fu_user.user_DOB',
                        'fu_user.gender', 'fu_user.user_email', 'fu_user.promotion', 'dra_curriculum.khoa','dra_curriculum.name', 'dra_curriculum.chuyen_nganh', 'fu_user.user_address',
                        'fu_user.user_telephone', 'fu_user.personal_email', 'fu_user.parent_email1', 'fu_user.cmt', 'fu_user.ph_telephone2', 'fu_user.parent_email1')
                    ->where('fu_user.curriculum_id', 0)
                    ->get();
                return view('admin.curriculums.student-list', compact('curriculums', 'curriculum'));

            } else {
                $curriculums = User::where('user_level', 3)->join('dra_curriculum', 'fu_user.curriculum_id', '=', 'dra_curriculum.id')
                    ->select('fu_user.user_code', 'fu_user.user_surname', 'fu_user.user_middlename', 'fu_user.user_givenname', 'fu_user.user_DOB',
                        'fu_user.gender', 'fu_user.user_email', 'fu_user.promotion', 'dra_curriculum.khoa','dra_curriculum.name', 'dra_curriculum.chuyen_nganh', 'fu_user.user_address',
                        'fu_user.user_telephone', 'fu_user.personal_email', 'fu_user.parent_email1', 'fu_user.cmt', 'fu_user.ph_telephone2', 'fu_user.parent_email1')
                    ->where('fu_user.curriculum_id', $curriculum_id)
                    ->get();
                return view('admin.curriculums.student-list', compact('curriculums', 'curriculum'));

            }
        } else {
            $curriculums = User::where('user_level', 3)->join('dra_curriculum', 'fu_user.curriculum_id', '=', 'dra_curriculum.id')
                ->select('fu_user.user_code', 'fu_user.user_surname', 'fu_user.user_middlename', 'fu_user.user_givenname', 'fu_user.user_DOB',
                    'fu_user.gender', 'fu_user.user_email', 'fu_user.promotion', 'dra_curriculum.khoa','dra_curriculum.name', 'dra_curriculum.chuyen_nganh', 'fu_user.user_address',
                    'fu_user.user_telephone', 'fu_user.personal_email', 'fu_user.parent_email1', 'fu_user.cmt', 'fu_user.ph_telephone2', 'fu_user.parent_email1')
                ->get();
            return view('admin.curriculums.student-list', compact('curriculums', 'curriculum'));
        }
    }

    public function index()
    {
        $curriculums = Curriculum::all();
        $departments = Department::all();
        return view('admin.curriculums.index', compact('curriculums', 'departments'));
    }

    public function create()
    {
        $brands = Brand::all();
        return view('admin.curriculums.create', compact('brands'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $curriculum = new Curriculum();
        $curriculum->fill($data);
        $curriculum->save();

        return redirect()->route('curriculum.index')->with('msg-add', 'Create Curriculum Successful');
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $curriculum = Curriculum::find($id);
        $brands = Brand::all();
        return view('admin.curriculums.edit', compact('curriculum', 'brands'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = $request->all();
        $curriculum = Curriculum::find($id);
        $curriculum->fill($data);
        $curriculum->save();

        return redirect()->route('curriculum.index')->with('msg-add', 'Update Curriculum Successful');
    }

    public function Search(Request $request)
    {
        $department_id = $request->department_id;
    }
}
