<?php

namespace App\Http\Controllers;

use App\Models\FeeT;
use App\Models\FeeT2;
use App\Models\Fu\Terms;
use App\Models\User;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terms = Terms::all();
        $fees = FeeT2::all();
        $users = User::select('study_status')->distinct('study_status')->get();
//        $totalStudent = User::selectRaw("count(case when study_status = '0' then 1 end) as graduated")
//            ->selectRaw("count(case when study_status = '4' then 1 end) as do")
//            ->selectRaw("count(case when study_status = '17' then 1 end) as pending")
//            ->selectRaw("count(case when study_status = '1' then 1 end) as intake")
//            ->selectRaw("count(case when study_status = '3' then 1 end) as deffer")
//            ->selectRaw("count(case when study_status = '5' then 1 end) as change_campus")
//            ->first();
        return view('admin.fees.index', compact('fees', 'terms', 'users'));
    }

    public function listStudent(Request $request) {
        $id = $request->id;
        $listStudent = FeeT2::where('term', $id)->get();

        return view('admin.fees.list-student', compact('listStudent'));
    }

    public function listFeeStudent(Request $request)
    {
        $fees = FeeT::where('term', $request->id)->get();
        return view('admin.fees.list', compact('fees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
