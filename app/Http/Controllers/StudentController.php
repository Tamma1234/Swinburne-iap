<?php

namespace App\Http\Controllers;

use App\Models\Evaluate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function Evaluate() {
        $evaluates = Evaluate::all();
        return view('admin.evaluates.index', compact('evaluates'));
    }

    public function detail(Request $request) {
        $id = $request->id;
        $evaluate = Evaluate::find($id);

        return view('admin.evaluates.detail', compact('evaluate'));
    }

    public function update(Request $request) {
        $id = $request->id;
        $date = Carbon::now()->toDateString();
        $evaluate = Evaluate::find($id);
        $evaluate->update([
            'user_login' => $evaluate->user_login,
            'loai_danh_gia' => $request->type,
            'noi_dung' => $request->noi_dung,
            'findding' => $request->findding,
            'solution' => $request->solution,
            'note' => $request->note,
            'ngay_danh_gia' => $date,
            'actor' => $evaluate->actor
        ]);

        return response()->json(["success" => "Update Evaluate Successful"]);
    }

    public function listStudentStatus(Request $request) {
        return view('admin.students.index');
    }
}
