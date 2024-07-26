<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use App\Models\Surveys;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        $surveys = Surveys::all();
        return view('admin.surveys.index', compact('surveys'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create() {
        $questions = Questions::where('parent_id', 0)->get();
        return view('admin.surveys.create', compact('questions'));
    }


    public function store(Request $request) {
//        $request->validate([
//            'name_survey' => 'required',
//            'description' => 'required',
//            'start_at' => 'required',
//            'end_at' => 'required',
//            'user_login' => 'required',
//            'question_id' => 'required',
//        ]);

        $user_code = $request->user_login;
        $users = json_decode($user_code);
        dd($users);
        $name = $request->name_survey;
        $description = $request->description;
        $start_at = $request->start_at;
        $end_at = $request->end_at;
        $user_login = $request->user_login;
        $question_id = $request->question_id;

        $survey = new Surveys();
        $survey->create([
            'name' => $name,
            'description' => $description,
            'start_at' => $start_at,
            'end_at' => $end_at
        ]);


        dd($request->all());
    }
}
